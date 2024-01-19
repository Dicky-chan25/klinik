<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::paginate();
        return view('jadwal/index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jadwal/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Jadwal' => 'required'
        ]);

        $Jadwal= Jadwal::create([

            'jadwalpraktek'=>$request->Jadwal

        ]);

        return redirect('jadwal/index')->with('success','Jadwal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwalvariabel)
    {
        $jadwalvariabel = Jadwal::where('id', $jadwalvariabel)->get();
        return view('jadwal', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = Jadwal::findOrfail($id);
        return view('jadwal/edit', compact('jadwal'));
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
            'jadwalpraktek' => 'required'
        ]);

        $jadwal = Jadwal::find($id);
        $jadwal->jadwalpraktek = $validated['jadwalpraktek'];
        $jadwal->save();

        return redirect('jadwal/index')->with('success', 'Data TerUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        return redirect('jadwal/index')->with('success', 'Data berhasil dihapus');
    }
}
