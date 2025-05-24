@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Data Stok Masuk</h3>
        <div class="box" style="opacity: 0.9;">
            <div style="display: flex; justify-content: flex-end; align-items: center;">
                <form action="{{ route('stokadmin.search') }}" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari Barang.."
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="30px">No</th>
                        <th>Nama Barang</th>
                        <th width="150px">Stok</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $currentPage = $datastok->currentPage();
                    $perPage = $datastok->perPage();
                    $totalItems = $datastok->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                    @endphp
                    @foreach ($datastok as $stok)
                    <tr>
                        <td>{{ $startingNumber++ }}</td>
                        <td>{{ $stok->Nama_Barang }}</td>
                        <td>{{ $stok->Stok_Masuk }}</td>
                        <td><img src="{{ asset('berkas_ujis/' . $stok->gambar) }}" alt="Gambar Stok" width="100"
                                height="100"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $datastok->links() }}
        </div>
    </div>
</div>
@endsection