@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container-fluid" style="min-height: 100vh;">
        <h3>Data Log Penitipan Hewan</h3>
        <div class="box" style="opacity: 0.9;">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>ID_penitipan</th>
                        <th>ID_pengguna</th>
                        <th>Aksi</th>
                        <th>Nama_hewan_new</th>
                        <th>Nama_hewan_old</th>
                        <th>Lama_hari_new</th>
                        <th>Lama_hari_old</th>
                        <th>Jenis_layanan_new</th>
                        <th>Jenis_layanan_old</th>
                        <th>Harga_new</th>
                        <th>Harga_old</th>
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logPenitipanHewan as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->ID_Penitipan }}</td>
                        <td>{{ $log->ID_Pengguna }}</td>
                        <td>{{ $log->Action }}</td>
                        <td>{{ $log->Nama_Hewan_New }}</td>
                        <td>{{ $log->Nama_Hewan_Old }}</td>
                        <td>{{ $log->Lama_Hari_New }}</td>
                        <td>{{ $log->Lama_Hari_Old }}</td>
                        <td>{{ $log->Jenis_Layanan_New }}</td>
                        <td>{{ $log->Jenis_Layanan_Old }}</td>
                        <td>{{ $log->Harga_New }}</td>
                        <td>{{ $log->Harga_Old }}</td>
                        <td>{{ $log->Diperbarui }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection