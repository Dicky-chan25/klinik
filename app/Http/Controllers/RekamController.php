<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Rekam;
use App\Models\Obat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RekamController extends Controller
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
        $validate = $request->validate([
            'id_player' => 'required',
            'layanan' => 'required',
            'keluhan' => 'required',
            'dokter' => 'required',
        	// 'g-recaptcha-response' => 'required|captcha'
        ]
        // ,
        // [
        //     'g-recaptcha-response' => [
        //         'required' => 'Please verify that you are not a robot.',
        //         'captcha' => 'Captcha error! try again later or contact site admin.',
        //     ],
        // ],
        );

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
        $pasientable = Pasien::where('id', $pasienid)->get();

        foreach ($pasientable as $row):

            return redirect('pasien/pasien-lama')->with([
                'addsuccess' => 'Data berhasil ditambahkan',
                'nomorAntrian' => "00" . $nomorAntrian,
                'nama' => $row->nama,
                'timestamps' => $Rekam->created_at->format('H:i:s'),
                'tanggaldaftar' => $Rekam->created_at->format('d-m-Y')
            ]);

        endforeach;
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
        $rekam = Rekam::find($id);
        return view('rekam/antrian-pasien-edit-form',[
            'rekam' => $rekam,
            'dokter' => Dokter::all()
        ]);
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
        $validated = $request->validate([
            'layanan' => 'required',
            'keluhan' => 'required',
            'dokter' => 'required'
        ]);

        $rekam = Rekam::find($id);
        $rekam->layanan = $validated['layanan'];
        $rekam->keluhan = $validated['keluhan'];
        $rekam->id_dokter = $validated['dokter'];
        $rekam->save();

        return redirect('rekam/antrian-pasien-admin')->with('success', 'Data TerUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rekam = Rekam::find($id);
        $rekam->delete();
        return back()->with('success', 'Data Terhapus');
    }

    public function edits($id)
    {
        $rekam = Rekam::find($id);
        return view('rekam/rekam-pasien-edit-form',[
            'rekam' => $rekam
        ]);
    }

    public function antrianpasien(){
        $data =Rekam::where('diagnosa', null)->get();
            return view('rekam/antrian-pasien-admin', [
                'datarekam' => $data
            ]);
        }

        public function rekamstore(Request $request)
        {
            $validated = $request->validate([
                'idpasien' => 'required',
                'layanan' => 'required',
                'keluhan' => 'required',
                'dokter' => 'required',
                'diagnosa' => 'required',
                'obat' => 'required',
                'jumlahobat' => 'required',
                'keterangan' => 'required'
            ]);
    
            Rekam::create([
                'jumlahobat' => $validated['jumlahobat'],
                'id_pasien' => $validated['idpasien'],
                'nomorantrian' => 0,
                'layanan' => $validated['layanan'],
                'keluhan' => $validated['keluhan'],
                'id_dokter' => $validated['dokter'],
                'diagnosa' => $validated['diagnosa'],
                'id_obat' => $validated['obat'],
                'keterangan' => $validated['keterangan']
            ]);
    
            $obat = Obat::find($validated['obat']);
            $obat->stok = $obat->stok - $validated['jumlahobat'];
            $obat->save();
    
            return back()->with('success', 'Data berhasil ditambahkan');
        }
        public function editrekam($od, $id)
        {
            return view('/rekam/edit-rekam-admin-form',[
                'rekam' => Rekam::find($id),
                'obat' => Obat::all(),
                'dokter' => Dokter::all(),
                'id_pasien' => $od
            ]);
        }
    
        public function updaterekam(Request $request)
        {
            $validated = $request->validate([
                'idrekam' => 'required',
                'layanan' => 'required',
                'keluhan' => 'required', 
                'dokter' => 'required', 
                'diagnosa' => 'required',
                'idpasien' => 'required',
                // 'obat' => '',
                // 'jumlahobat' => '',
                // 'keterangan' => '',
                // 'Ruang' => '',
                // 'Darah' => '',
                // 'Tinggi' => '',
                // 'Berat' => '',
                // 'LingkarBadan' => ''
            ]); 
            
            
            $rekam = Rekam::find($validated['idrekam']);
    
            if($request->obat != '' && $request->jumlahobat != '')
            {
                $obat = Obat::find($request->obat);
                $obat->stok = $obat->stok + $rekam->jumlahobat - $request->jumlahobat;
                $obat->save();
            }
    
            $rekam->layanan = $validated['layanan'];
            $rekam->keluhan = $validated['keluhan'];
            $rekam->id_dokter = $validated['dokter'];
            $rekam->diagnosa = $validated['diagnosa'];
    
            $rekam->id_obat = $request->obat;
            $rekam->jumlahobat = $request->jumlahobat;
            $rekam->keterangan = $request->keterangan;
            $rekam->rawat = $request->Ruang;
            $rekam->darah = $request->Darah;
            $rekam->tinggi = $request->Tinggi;
            $rekam->berat = $request->Berat;
            $rekam->pinggang = $request->LingkarBadan;
            $rekam->save();
    
            $pasien = Pasien::findOrfail($validated['idpasien']);
            $rekam = Rekam::where('id_pasien', $validated['idpasien'])->whereNotNull('diagnosa')->get();
    
            return back()->with('success', 'Data terupdate');
        }

        // -------------------------------------------------------- Diagnosa------------------------------------------------------------------------------

        public function diagnosa(){
            $data = Rekam::where('diagnosa', null)->get();
            return view('/rekam/diagnosa', [
                'data' => $data
            ]); 
        }

        public function editdiagnosa($id)
        {
            $diagnosa = Rekam::find($id);
            return view('rekam/diagnosa-form', [
                'diagnosa' => $diagnosa,
                'obat' => Obat::all()
            ]);
        }
        
        public function updatediagnosa(Request $request, $id)
        {
            $validated = $request->validate([
                // 'kodepasien' => 'required',
                'diagnosa' => 'required',
                // 'obat' => 'required',
                // 'jumlahobat' => 'required',
                // 'keterangan' => 'required',
                // 'Ruang' => 'required',
                // 'Darah' => 'required',
                // 'Tinggi' => 'required',
                // 'Berat' => 'required',
                // 'LingkarBadan' => 'required'
            ]); 
    
            $rekam = Rekam::find($id);
            $rekam->diagnosa = $validated['diagnosa'];
            // $rekam->laporan = 1;
            $rekam->nomorantrian = 000;
    
            if($request->obat != ''){
                $rekam->id_obat = $request->obat;
            }
    
            if($request->jumlahobat != ''){
                $rekam->jumlahobat = $request->jumlahobat;
            }
    
            if($request->keterangan != ''){
                $rekam->keterangan = $request->keterangan;
            }
            
            if($request->Ruang != ''){
                $rekam->rawat = $request->Ruang;
            }
            
            if($request->Lamabaru != ''){
                $rekam->lamabaru = $request->Lamabaru;
            }
    
            if($request->Darah != ''){
                $rekam->darah = $request->Darah;
            }
    
            if($request->Berat != ''){
                $rekam->berat = $request->Berat;
            }
    
            if($request->LingkarBadan != ''){
                $rekam->pinggang = $request->LingkarBadan;
            }
    
            if($request->obat != ''){
                $obat = Obat::find($request->obat);
                $obat->stok = $obat->stok - $request->jumlahobat;
                $obat->save();
            }
            // $rekam->jumlahobat = $validated['jumlahobat'];
            // // $rekam->keterangan = $validated['keterangan'];
            // $rekam->rawat = $validated['Ruang'];
            // $rekam->darah = $validated['Darah'];
            // $rekam->tinggi = $validated['Tinggi'];
            // $rekam->berat = $validated['Berat'];
            // $rekam->pinggang = $validated['LingkarBadan'];
            $rekam->save();
            
            $idpasien = $rekam->id_pasien;
            
            if($request->kodepasien != '')
            {
                $pasien = Pasien::find($idpasien);
                $pasien->kodepasien = $request->kodepasien.$pasien->kodepasien;
                $pasien->save();
            }
            return redirect('/rekam/diagnosa')->with('success', 'Sukses memberi diagnosa');

            // return back()->with('success', 'Sukses memberi diagnosa');
          
        }
}
