@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container-fluid" style="min-height: 100vh;">
        <h3>Data Log Pengguna</h3>
        <div class="box" style="opacity: 0.9;">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr style="font-size: 14px;">
                        <th>ID_pengguna</th>
                        <th>Aksi</th>
                        <th>Nama_akun_new</th>
                        <th>Nama_akun_old</th>
                        <th>username_new</th>
                        <th>username_old</th>
                        <th>no_telp_new</th>
                        <th>no_telp_old</th>
                        <th>email_new</th>
                        <th>email_old</th>
                        <th>peran_new</th>
                        <th>peran_old</th>
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logPengguna as $log)
                    <tr>
                        <td>{{ $log->ID_Pengguna }}</td>
                        <td>{{ $log->Action }}</td>
                        <td>{{ $log->Nama_Akun_New }}</td>
                        <td>{{ $log->Nama_Akun_Old ?? 'N/A' }}</td>
                        <td>{{ $log->Nama_Pengguna_New }}</td>
                        <td>{{ $log->Nama_Pengguna_Old ?? 'N/A' }}</td>
                        <td>{{ $log->No_Telp_New }}</td>
                        <td>{{ $log->No_Telp_Old ?? 'N/A' }}</td>
                        <td>{{ $log->Email_New }}</td>
                        <td>{{ $log->Email_Old ?? 'N/A' }}</td>
                        <td>{{ $log->Peran_New }}</td>
                        <td>{{ $log->Peran_Old ?? 'N/A' }}</td>
                        <td>{{ $log->Diperbarui }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $logPengguna->links() }}
            </div>
        </div>
    </div>
</div>
@endsection