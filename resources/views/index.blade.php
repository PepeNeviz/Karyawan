@extends('layouts.main')

@section('content')

<div class="p-5">

    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-2xl font-bold text-white">Data Karyawan</h1>

        <a href="{{ route('karyawan.tambah') }}" 
            class="bg-blue-500 hover:bg-blue-400 text-white px-4 py-2 rounded-lg shadow transition">
            + Tambah
        </a>
    </div>

    <!-- Search + Sort -->
    <form method="GET" class="mb-6 flex flex-wrap gap-3">
        <input type="text" name="search" 
            value="{{ request('search') }}"
            placeholder="Cari nama..."
            class="px-4 py-2 rounded-lg bg-[#1e293b] border border-slate-600 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">

        <select name="sort" 
            class="px-4 py-2 rounded-lg bg-[#1e293b] border border-slate-600 text-white focus:outline-none">
            <option value="">Urutkan</option>
            <option value="asc" {{ request('sort')=='asc'?'selected':'' }}>Gaji Terendah</option>
            <option value="desc" {{ request('sort')=='desc'?'selected':'' }}>Gaji Tertinggi</option>
        </select>

        <button class="bg-cyan-500 hover:bg-cyan-400 px-4 py-2 rounded-lg transition">
            Cari
        </button>
    </form>

    <!-- Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($karyawan as $p)
        <div class="bg-[#1e293b] border border-cyan-400/20 rounded-2xl p-5 shadow-lg 
                    hover:scale-105 hover:shadow-cyan-400/30 transition duration-300">

            <!-- Nama -->
            <h3 class="text-xl font-bold text-white">
                {{ $p->nama }}
            </h3>

            <!-- Posisi -->
            <p class="text-sm text-slate-400 mb-3">
                {{ $p->posisi }}
            </p>

            <div class="border-t border-slate-600 my-3"></div>

            <!-- Stats -->
            <div class="space-y-2 text-sm">
                <p class="text-green-400 font-medium">
                    Gaji: {{ $p->gaji->jumlah_gaji ?? 'Tidak ada' }}
                </p>
                <p class="text-yellow-400 font-medium">
                    Bonus: {{ $p->gaji->bonus ?? 'Tidak ada' }}
                </p>
            </div>

            <div class="border-t border-slate-600 my-3"></div>

            <!-- Aksi -->
            <div class="flex justify-between items-center text-sm">
                <a href="/karyawan/{{ $p->id }}" 
                    class="text-blue-400 hover:text-blue-300 transition">
                    Edit
                </a>

                <form action="{{ route('karyawan.delete', ['id' => $p->id ])}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" 
                            class="text-red-400 hover:text-red-300 transition">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
        @endforeach

    </div>

</div>

@endsection