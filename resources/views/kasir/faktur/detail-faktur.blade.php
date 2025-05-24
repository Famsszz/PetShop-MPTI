@extends('layouts.mainkasir')
@section('container')
<!-- content -->
<div class="container">
    <br>
    <h1>Rincian Pesanan</h1>
</div>

<div class="container">
    <div class="box">
        <h3>Produk Pesanan @if(isset($detailFaktur[0]))
            {{ $detailFaktur[0]->Pengguna }}
            @endif
        </h3>
        <br>
        <table border="1" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th width="60px">No</th>
                    <th>Nama Produk</th>
                    <th width="150px">Harga</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalKeseluruhan = 0;
                @endphp
                @foreach ($detailFaktur as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->Barang }}</td>
                    <td>{{ number_format($item->Harga_Satuan,2) }}</td>
                    <td>{{ $item->jumlah_stok_dipesan }}</td>
                    @php
                    $subtotal = $item->Harga_Satuan * $item->jumlah_stok_dipesan;
                    $totalKeseluruhan += $subtotal;
                    @endphp
                    <td>Rp. {{ number_format($subtotal,2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="3"></th>
                    <th>Total Keseluruhan: </th>
                    <th>Rp. {{ number_format($totalKeseluruhan,2) }}</th>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
    <a class="btn" href="/cetak-faktur/{{ $detailFaktur->first()->ID_Transaksi }}"> <i class="bi bi-printer-fill"></i> Cetak Faktur</a>
</div>
    </div>
</div>

@endsection