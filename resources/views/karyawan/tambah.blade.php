@extends('layouts.main')

@section('content')

<div class="max-w-xl mx-auto p-5">

    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-2xl font-bold text-white">Tambah Karyawan</h1>

        <a href="{{ route('karyawan') }}" 
            class="text-slate-400 hover:text-white transition">
            Kembali
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('karyawan.create') }}" method="POST" 
            class="bg-[#1e293b] p-6 rounded-2xl border border-cyan-400/20 shadow-lg space-y-4">
        @csrf

        <!-- Nama -->
        <div>
            <label class="block text-sm text-slate-300 mb-1">Nama</label>
            <input type="text" name="nama"
                class="w-full px-4 py-2 rounded-lg bg-[#0f172a] border border-slate-600 text-white focus:ring-2 focus:ring-cyan-400"
                required>
        </div>

        <!-- Posisi -->
        <div>
            <label class="block text-sm text-slate-300 mb-1">Posisi</label>
            <input type="text" name="posisi"
                class="w-full px-4 py-2 rounded-lg bg-[#0f172a] border border-slate-600 text-white focus:ring-2 focus:ring-cyan-400"
                required>
        </div>

        <!-- Gaji -->
        <div>
            <label class="block text-sm text-slate-300 mb-1">Gaji</label>
            <input type="number" name="jumlah_gaji"
                class="w-full px-4 py-2 rounded-lg bg-[#0f172a] border border-slate-600 text-white focus:ring-2 focus:ring-green-400"
                required>
        </div>

        <!-- Bonus -->
        <div>
            <label class="block text-sm text-slate-300 mb-1">Bonus</label>
            <input type="number" name="bonus"
                class="w-full px-4 py-2 rounded-lg bg-[#0f172a] border border-slate-600 text-white focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Button -->
        <button type="submit"
            class="w-full bg-cyan-500 hover:bg-cyan-400 text-white py-2 rounded-lg transition">
            Simpan
        </button>

    </form>

</div>

@endsection