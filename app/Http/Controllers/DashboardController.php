<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Rekam; 
use App\Models\Obat; 
use App\Models\Pasien; 

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pendaftaran(){
        $data = Dokter::all();
        return view('dashboard/pendaftaran', [
            'dokter' => $data
        ]);
    }

   
    
        public function cekpasienlama(Request $request){
            $validated = $request->validate([
                "Nama" => 'required',
                "Lahir" => 'required'
            ]);
    
            $nama = $validated['Nama'];
            $lahir = $validated['Lahir'];
    
            $data = DB::table('pasiens')->where('nama', $nama)->where('lahir', $lahir)->get();
    
            if(count($data)>0){
                foreach($data as $row):
                return redirect('/dashboard/pendaftaran')->with([
                    'success' => 'Data ditemukan',
                    'nama' => $row->nama,
                    'lahir' => $row->lahir,
                    'alamat' => $row->alamat,
                    'kelamin' => $row->kelamin,
                    'id' => $row->id
                ]);
                endforeach;
            } else{
                return redirect('/dashboard/pendaftaran')->with([
                    'failed' => 'Data tidak ditemukan'
                ]);
            }
        }
    
        public function addrekam(Request $request){
            $validate = $request->validate([
                'id_player' => 'required',
                'layanan' => 'required',
                'keluhan' => 'required',
                'dokter' => 'required'
            ]);
    
            $nomorAntrian = 1;
            $cekData = Rekam::whereDate('created_at', Carbon::today())->latest()->first();
            if ($cekData) {
                $nomorAntrian = $cekData->nomorantrian + 1;
            }
    
            $Rekam = Rekam::create([
                'nomorantrian' => "00" . $nomorAntrian,
                'id_pasien' => $validate['id_player'],
                'layanan' => $validate['layanan'],
                'keluhan' => $validate['keluhan'],
                'id_dokter' => $validate['dokter']
            ]);
    
            $latestrekam = Rekam::all()->last();
            $pasienid = $latestrekam->id_pasien;
            $pasientable = DB::table('pasiens')->where('id', $pasienid)->get();
    
            foreach ($pasientable as $row):
    
                return redirect('dashboard/pendaftaran')->with([
                    'addsuccess' => 'Data berhasil ditambahkan'
                ]);
    
            endforeach;
        }
    
        public function tambahpasienform(){
            $data = Dokter::all();
            return view('dashboard/tambahpasienform', [
                'dokter' => $data
            ]);
        }
    
        public function tambahpasien(Request $request){
            $this->validate($request, [
                'Nama' => 'required',
                'Alamat' => 'required',
                'Lahir' => 'required',
                'NIK' => 'required',
                'Kelamin' => 'required',
                'Telepon' => 'required',
                'Agama' => 'required',
                'Pendidikan' => 'required',
                'Pekerjaan' => 'required',
                'layanan' => 'required',
                'RekamMedis' => 'required',
                'dokter' => 'required'
            ]);
    
            $Pasien= Pasien::create([
                'nama'=>ucwords(strtolower($request->Nama)),
                'alamat'=>$request->Alamat,            
                'lahir'=>$request->Lahir,            
                'nik'=>$request->NIK,
                'kelamin'=>$request->Kelamin,
                'telepon'=>$request->Telepon,
                'agama'=>$request->Agama,
                'pendidikan'=>$request->Pendidikan,
                'pekerjaan'=>$request->Pekerjaan
            ]);
    
            // $kode= 100000+ (integer)$Pasien -> id;
            // $nomer= substr($kode, 1, 5). $Pasien -> lahir -> format ('dmy');
            // $Pasien -> kodepasien = $nomer ;
            // $Pasien -> save();
            
            $nomer= $Pasien -> lahir -> format ('dmy');
            $Pasien -> kodepasien = $nomer ;
            $Pasien -> save();
    
            $nomorAntrian = 1;
            $cekData = Rekam::whereDate('created_at', Carbon::today())->latest()->first();
            if($cekData){
                $nomorAntrian = $cekData->nomorantrian + 1;
            }
    
            $latestpasien = Pasien::all()->last();
            Rekam::create([
                'nomorantrian' => "00".$nomorAntrian,
                'id_pasien' => $latestpasien->id,
                'layanan' => $request->layanan,
                'keluhan' => $request->RekamMedis,
                'id_dokter' => $request->dokter
            ]);
    
            if (isset($request->daftarPasien)){
                return back()->with([
                    'success' => 'Data berhasil ditambahkan',
                    'nomorAntrian' => "00".$nomorAntrian,
                    'nama' => $request->Nama,
                    'timestamps' => $Pasien->created_at -> format ('H:i:s'),
                    'tanggaldaftar' => $Pasien->created_at -> format ('d-m-Y')
                ]);
            }
    
            return redirect('dashboard/pendaftaran')->with('addsuccess','Data berhasil ditambahkan');
        }
    
        public function deleteantrianadmin($id)
        {
            $rekam = Rekam::find($id);
            $rekam->delete();
            return view('antrian-pasien-admin');
        }
    
       
    
        public function indexlaporan()
        {
            return view('laporan-harian',[
                'data' => Rekam::where('laporan', 1)->whereNotNull('diagnosa')->get(),
                'count' => 0
            ]);
        }
    
        public function clearlaporan()
        {
            Rekam::where('laporan', 1)->update(['laporan'=>2]);
            return redirect('/laporan-harian')->with('success', 'Berhasil clear data');
        }
}
