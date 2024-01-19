<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obat = Obat::paginate();
        if(request('search')){
            $obat->where('namaobat', 'like','%' . request('search') . '%');
        }
        return view('obat_page/total_stok', [
            "obat" => $obat
        ]);
    }
    // public function cari(Request $request)
	// {
	// 	// menangkap data pencarian
	// 	$cari = $request->cari;
 
    // 		// mengambil data dari table pegawai sesuai pencarian data
	// 	$obat = DB::table('obat')
	// 	->where('id_jenis','like',"%".$cari."%");
 
    // 		// mengirim data pegawai ke view index
	// 	return view('obat_page/total_stok',['obat' => $obat]);
 
	// }
    public function form()
    {
        return view('obat_page.obat_form', [
            'jenis' => Jenis::all(),

        ]);
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
        $validated = $request->validate([
            'namaobat' => 'required|max:255',
            'kodeobat' => 'required',
            'expired' => 'required',
            'stok' => 'required',
            'dosis' => 'required',
            'harga' => 'required',
            // 'image' => 'image',

        ]);

        // if($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->store('post-images');
        // }
        
        Obat::create([
            'kodeobat' => $validated['kodeobat'],
            'namaobat' => $validated['namaobat'],
            'id_jenis' => $request->jenis,
            'expired' => $validated['expired'],
            'stok' => $validated['stok'],
            'dosis' => $validated['dosis'],
            // 'image' => $validated['image'],
            'harga' => $validated['harga']
        ]);

        return redirect('obat_page/total_stok')->with('success', 'Data berhasil dibuat');
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
        return view('obat_page.edit', [
            'data' => Obat::find($id),
            'jenis' => Jenis::all()
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
        $request->validate([
            'namaobat' => 'required'
        ]);

        $validated = $request->all();
        
        // if ($image = $request->file('image')) {
        //     $destinationPath = 'image/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $validated['image'] = "$profileImage";
        // }else{
        //     unset($validated['image']);
        // }

        $date = date('Y-m-d H:i:s');

        $data = Obat::find($id);
        $data->kodeobat = $request->kodeobat;
        $data->namaobat = $validated['namaobat'];
        $data->id_jenis = $request->jenis;
        $data->expired = $request->expired;
        $data->dosis = $request->dosis;
        $data->created_at = $date;
        $data->harga = $request->harga;
        
        // if($image != ''){
        //     $data->image = $validated['image'];
        // }

        $data->save();

        return redirect('obat_page/total_stok')->with('success', 'Data terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obat = Obat::find($id);
        $obat->delete();

        return redirect('obat_page/total_stok')->with('success', 'Data berhasil dihapus');
    }

    public function editstok($id)
    {
        return view('edit-stok-obat-form', [
            'obat' => Obat::find($id)
        ]);
    }

    public function tambahstok(Request $request)
    {
        $validated = $request->validate([
            'id_obat' => 'required',
            'jumlahtambahan' => 'required'
        ]);

        $date = date('Y-m-d H:i:s');

        $obat = Obat::find($validated['id_obat']);
        $obat->stok = $obat->stok + $validated['jumlahtambahan'];
        $obat->expired = $request->expired;
        $obat->created_at = $date;
        $obat->save();

        return redirect('obat-total-stok')->with('success', 'Stok terupdate');
    }
}
