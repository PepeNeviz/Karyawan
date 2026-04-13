<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Gaji;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::with('gaji');

        // search
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // sorting TANPA join
        if ($request->sort == 'asc') {
            $query->orderBy(
                Gaji::select('jumlah_gaji')
                    ->whereColumn('gajis.karyawan_id', 'karyawans.id'),
                'asc'
            );
        } elseif ($request->sort == 'desc') {
            $query->orderBy(
                Gaji::select('jumlah_gaji')
                    ->whereColumn('gajis.karyawan_id', 'karyawans.id'),
                'desc'
            );
        }

        $karyawan = $query->get();

        return view('index', compact('karyawan'));
    }

    public function create()
    {
        return view('karyawan.tambah');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'posisi' => 'required',
            'jumlah_gaji' => 'required|numeric',
            'bonus' => 'nullable|numeric'

        ]);

        $karyawan = Karyawan::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi
        ]);

        $gaji = Gaji::create([
            'karyawan_id' => $karyawan->id,
            'jumlah_gaji' => $request->jumlah_gaji,
            'bonus' => $request->bonus
        ]);

        return redirect('/karyawan');
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'posisi' => 'required',
        ]);

        $karyawan->update([
            'nama' => $request->nama,
            'posisi' => $request->posisi
        ]);

        return redirect('/karyawan');
    }
    
    public function show()
    {
        return view('karyawan.tambah');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        return view('karyawan.edit', ['karyawan' => $karyawan]);
    }

    public function destroy($id)
    {
        Karyawan::destroy($id);

        return redirect('/karyawan');
    }

}
