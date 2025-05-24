@extends('layouts.mainkasir')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Data Hewan Adopsi</h3>
        <div class="box" style="opacity: 0.9;">
            <!-- <p><a href="tambah-produk.php">Tambah Data</a></p> -->
            <p style="text-align: left;">
                <a href="/tambahhewanadopsi">Tambah Data</a>
            </p>

            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Kategori</th>
                        <th>Nama Hewan</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>deskripsi</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataadopsi as $adopsi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $adopsi->Nama_Kategori }}</td>
                        <td>{{ $adopsi->Nama_Hewan }}</td>
                        <td>{{ $adopsi->Harga_Satuan }}</td>
                        <td>{{ $adopsi->Stok_Jual }}</td>
                        <td>
                            <img src="{{ asset('berkas_ujis/' . $adopsi->gambar) }}" alt="Gambar Hewan Adopsi"
                                width="100" height="100">
                        </td>
                        <td>{{ $adopsi->Status }}</td>
                        <td>{{ $adopsi->deskripsi }}</td>
                        <td>
                            <a href="/edithewanadopsi/{{ $adopsi->ID_Barang }}">Edit</a> ||
                            <form action="/datahewanadopsi/{{ $adopsi->ID_Barang }}" method="post" class="d-inline">
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
        </div>
    </div>
</div>
@endsection