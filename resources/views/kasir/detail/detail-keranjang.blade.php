@extends('layouts.mainkasir')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Keranjang Barang
            <a href="/pengambilan-kasir" style="color:black; margin-left:10px;"><i class="bi bi-box-fill"></a></i>
        </h3>
        <div class="boxx">
            <div class="mb-3">
                <form action="/datapesanankasir/terima-semua2" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menerima semua pesanan ini?')">
                    @csrf
                    @if($keranjang->first())
                    <input type="hidden" name="ID_Transaksi" value="{{ $keranjang->first()->ID_Transaksi }}">
                    @endif
                    <button class="btn btn-success">Terima Semua</button>
                </form>
            </div>
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
                        <th width="60px">No</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Detail Produk</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Banyak</th>
                        <th style="width: 125px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang as $krjg)
                    <tr>
                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="boxImageKeranjang mx-auto">
                                <img class="img-fluidd-tes" src="{{ asset('berkas_ujis/' . $krjg->gambar) }}" style="object-fit: contain;">
                            </div>
                        </td>
                        <td class="align-middle text-center">{{ $krjg->Nama_Kategori }}</td>
                        <td class="align-middle text-center">{{ $krjg->Barang }}</td>
                        <td class="align-middle text-center">{{ $krjg->deskripsi }}</td>
                        <td class="align-middle text-center">{{ $krjg->Harga_Satuan }}</td>
                        <td class="align-middle text-center">{{ $krjg->status }}</td>
                        <td class="align-middle text-center">{{ $krjg->jumlah_stok_dipesan }}</td>
                        <td id="statusCell{{ $krjg->ID_barangjual }}" class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <!-- <form action="/datapesanankasir/terima/{{ $krjg->ID_barangjual }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menerima pesanan ini?')">
                                    @csrf
                                    <button class="badge bg-success border-0">Terima</button>
                                </form> -->

                                <form action="/datapesanankasir/tolakbarangjual/{{ $krjg->ID_barangjual }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menolak pesanan ini?')">
                                    @csrf
                                    <button class="badge bg-danger border-0">Tolak</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection