@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container-fluid" style="min-height: 100vh;">
        <h3>Data Log Stok Masuk</h3>
        <div class="box" style="opacity: 0.9;">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>ID_StokMasuk</th>
                        <th>ID_Barang</th>
                        <th>Stok_Masuk_Old</th>
                        <th>Stok_Masuk_New</th>
                        {{-- <th>Aksi</th> --}}
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logStokMasuk as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->ID_StokMasuk ?? 'N/A' }}</td>
                        <td>{{ $log->ID_Barang ?? 'N/A' }}</td>
                        <td>{{ $log->Stok_Masuk_Old ?? 'N/A' }}</td>
                        <td>{{ $log->Stok_Masuk_New ?? 'N/A' }}</td>
                        {{-- <td>{{ $log->Aksi ?? 'N/A' }}</td> You need to specify how you want to display the action
                        --}}
                        <td>{{ $log->Diperbarui ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection