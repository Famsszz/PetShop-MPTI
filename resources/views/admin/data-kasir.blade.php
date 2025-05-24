@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Data Kasir</h3>
        <div class="box" style="opacity: 0.9;">
            <p style="text-align: left;">
                <a href="/tambahkasir">Tambah Kasir</a>
            </p>
            <table border="1" cellspacing="0" class="table">
                <thead>
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
                    @foreach($kasir as $kasir)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kasir->Nama_Akun }}</td>
                        <td>{{ $kasir->Nama_Pengguna }}</td>
                        <td>{{ $kasir->No_Telp }}</td>
                        <td>{{ $kasir->email }}</td>
                        <td>
                            <a href="/editkasir/{{ $kasir->ID_Pengguna }}">Edit</a> ||
                            <form action="/datakasir/{{ $kasir->ID_Pengguna }}" method="post" class="d-inline">
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