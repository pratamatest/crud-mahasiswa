<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index() {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function store(Request $request) {
        $request->validate([
            'npm' => 'required|unique:mahasiswas',
            'nama_lengkap' => 'required',
            'prodi' => 'required',
            'fakultas' => 'required',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id) {
        Mahasiswa::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
