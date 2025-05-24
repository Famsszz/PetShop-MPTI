@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container-fluid" style="min-height: 100vh;">
        <h3>Data Log stok</h3>
        <div class="box" style="opacity: 0.9;">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>ID_Keranjang</th>
                        <th>ID_Penitipan</th>
                        <th>ID_Pengguna</th>
                        <th>Aksi</th>
                        <th>Tanggal_Old</th>
                        <th>Tanggal_New</th>
                        <th>Jam_new</th>
                        <th>Jam_old</th>
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logKeraID_Keranjang as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->ID_Keranjang }}</td>
                        <td>{{ $log->ID_Penitipan }}</td>
                        <td>{{ $log->ID_Pengguna }}</td>
                        <td>{{ $log->Action }}</td>
                        <td>{{ $log->Tanggal_Old }}</td>
                        <td>{{ $log->Tanggal_New }}</td>
                        <td>{{ $log->Jam_New }}</td>
                        <td>{{ $log->Jam_Old }}</td>
                        <td>{{ $log->Diperbarui }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection