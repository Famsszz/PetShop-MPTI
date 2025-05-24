@extends('layouts.mainkasir')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh; width:700px;">
        <h3>Keranjang Barang
            <a href="/pengambilan-kasir" style="color:black; margin-left:10px;"><i class="bi bi-box-fill"></a></i>
        </h3>
        <div class="boxx" style="opacity: 0.9;">
            <table border="1" cellspacing="0" class="table">
                <thead>
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
                    <tr>
                        <th>Nama Pemilik</th>
                        <th>Status</th>
                        <th>Kode Transaksi</th>
                        <th>Waktu</th>
                        <th style="width: 125px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $penggunaTerlihat = [];
                    @endphp

                    @foreach ($keranjang as $krjg)
                    @if (!in_array($krjg->Pengguna . $krjg->ID_Transaksi, $penggunaTerlihat))
                    <tr>
                        <td class="align-middle text-center">{{ $krjg->Pengguna }}</td>
                        <td class="align-middle text-center">{{ $krjg->status }}</td>
                        <td class="align-middle text-center">{{ $krjg->ID_Transaksi }}</td>
                        <td class="align-middle text-center">{{ $krjg->Dibeli }}</td>
                        <td class="align-middle text-center"><a
                                href="/detailkeranjang/{{$krjg->ID_Transaksi}}">Detail</a></td>
                    </tr>
                    @php
                    $penggunaTerlihat[] = $krjg->Pengguna . $krjg->ID_Transaksi;
                    @endphp
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection