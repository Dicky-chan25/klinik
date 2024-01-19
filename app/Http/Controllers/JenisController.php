<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;



class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jenis::paginate();
        return view('jenis_obat/index',[
            'jenis' => $data,
            'count' => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis_obat/create', [
            'jenis' => Jenis::all()
        ]);
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
            'jenis' => 'required'
        ]);

        Jenis::create([
            'jenisobat' => $validated['jenis']
        ]);
        
        return redirect('jenis_obat/index')->with('success', 'Data berhasil dibuat');
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
        $data = Jenis::find($id);

        return view('jenis_obat/edit', [
            'jenis' => $data
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
            'jenis' => 'required'
        ]);

        $jenis = Jenis::find($id);
        $jenis->jenisobat = $validated['jenis'];
        $jenis->save();

        return redirect('jenis_obat/index')->with('success', 'Data TerUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = Jenis::find($id);
        $jenis->delete();

        return redirect('jenis_obat.index')->with('success', 'Data berhasil dihapus');
    }
}
 