<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('pengelola.kelola_fasilitas', compact('fasilitas'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_fasilitas' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fasilitas', 'public');
        }

        Fasilitas::create($data);

        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $data = $request->validate([
            'nama_fasilitas' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fasilitas', 'public');
        }

        $fasilitas->update($data);

        return redirect()->back()->with('success', 'Fasilitas berhasil diupdate');
    }

    public function destroy($id)
    {
        Fasilitas::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Fasilitas berhasil dihapus');
    }
}
