@extends('layouts.mainadmin')
@section('container')
    <div class="section">
        <div class="container" style="min-height: 100vh;">
            <h3>Data Pengguna</h3>
            <div class="box" style="opacity: 0.9;">
                <div style="display: flex; justify-content: flex-end; align-items: center;">
                    <form action="{{ route('pelanggan.search') }}" method="GET" class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="Cari Pelanggan.."
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <tr>
                            <th width="60px">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $currentPage = $pelanggan->currentPage();
                            $perPage = $pelanggan->perPage();
                            $totalItems = $pelanggan->total();
                            $startingNumber = ($currentPage - 1) * $perPage + 1;
                        @endphp
                        @foreach ($pelanggan as $datapelanggan)
                            <tr>
                                <td>{{ $startingNumber++ }}</td>
                                <td>{{ $datapelanggan->Nama_Akun }}</td>
                                <td>{{ $datapelanggan->Nama_Pengguna }}</td>
                                <td>{{ $datapelanggan->No_Telp }}</td>
                                <td>{{ $datapelanggan->email }}</td>
                                <td>
                                    <form action="/datapengguna/{{ $datapelanggan->ID_Pengguna }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pelanggan->links() }}
            </div>
        </div>
    </div>
@endsection
