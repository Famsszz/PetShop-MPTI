@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container-fluid" style="min-height: 100vh;">
        <h3>Data Log Barang</h3>
        <div class="box" style="opacity: 0.9;">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>ID_barang</th>
                        <th>Aksi</th>
                        <th>Nama_barang old</th>
                        <th>Nama_barang new</th>
                        <th>Harga_satuan old</th>
                        <th>Harga_satuan new</th>
                        <th>Status old</th>
                        <th>Status new</th>
                        <th>Deskripsi old</th>
                        <th>Deskripsi new</th>
                        <th>Gambar old</th>
                        <th>Gambar new</th>
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logBarang as $log)
                    <tr>
                        <td>{{ $log->ID_Barang }}</td>
                        <td>{{ $log->Action }}</td>
                        <td>{{ $log->Nama_Barang_Old ?? 'N/A' }}</td>
                        <td>{{ $log->Nama_Barang_New ?? 'N/A' }}</td>
                        <td>{{ $log->Harga_Satuan_Old ?? 'N/A' }}</td>
                        <td>{{ $log->Harga_Satuan_New ?? 'N/A' }}</td>
                        <td>{{ $log->Status_Old ?? 'N/A' }}</td>
                        <td>{{ $log->Status_New ?? 'N/A' }}</td>
                        <td>{{ $log->deskripsi_Old ?? 'N/A' }}</td>
                        <td>{{ $log->deskripsi_New ?? 'N/A' }}</td>
                        <td>
                            @if ($log->gambar_Old)
                            <img src="{{ asset('berkas_ujis/' . $log->gambar_Old) }}" alt="Gambar Stok" width="100"
                                height="100">
                            @else
                            <p>No Image</p>
                            @endif
                        </td>
                        <td>
                            @if ($log->gambar_New)
                            <img src="{{ asset('berkas_ujis/' . $log->gambar_New) }}" alt="Gambar Stok" width="100"
                                height="100">
                            @else
                            <p>No Image</p>
                            @endif
                        </td>
                        <td>{{ $log->Diperbarui }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $logBarang->links() }}
        </div>
    </div>
</div>
@endsection