@extends('layouts.mainkasir')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Data Stok Masuk</h3>
        <div class="box" style="opacity: 0.9;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <p style="text-align: left;">
                    <a href="/tambahstokmasuk">Tambah Stok Satuan</a>
                </p>
                <p style="text-align: left;">
                    <a href="/tambahstokmasukpecah">Tambah Stok Pecah</a>
                </p>
                <form action="{{ route('stok.search') }}" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search"
                        aria-label="Cari Stok..">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="30px">No</th>
                        <th>Nama Barang</th>
                        <th width="150px">Stok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $currentPage = $datastokkasir->currentPage();
                    $perPage = $datastokkasir->perPage();
                    $totalItems = $datastokkasir->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                    @endphp
                    @foreach ($datastokkasir as $stok)
                    <tr>
                        <td>{{ $startingNumber++ }}</td>
                        <td>{{ $stok->Nama_Barang }}</td>
                        <td>{{ $stok->Stok_Masuk }}</td>
                        <td><img src="{{ asset('berkas_ujis/' . $stok->gambar) }}" alt="Gambar Stok" width="100"
                                height="100"></td>
                        <td>
                            <form action="/datastokkasir/{{ $stok->ID_StokMasuk}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0"
                                    onclick="return confirm('Are you sure?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $datastokkasir->links() }}
        </div>
    </div>
</div>
@endsection