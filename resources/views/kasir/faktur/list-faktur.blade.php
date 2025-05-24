@extends('layouts.mainkasir')
@section('container')
<!-- content -->
<div class="container">
    <br>
    <h3>List Faktur</h3>
</div>


<div class="container">
    @foreach ($faktur as $item)
    <a href="/detail-faktur/{{ $item->ID_Transaksi }}">
        <div class="box" style="opacity: 0.9;">
            <h3>Nomor Faktur: {{ $item->ID_Transaksi }}</h3>
            <br>
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Nama Pembeli</th>
                        <!-- <th>Metode Pembayaran</th> -->
                        <th>Status</th>
                        <!-- <th>&nbsp;</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $item->ID_Transaksi }}</td>
                        <td>{{ $item->Pengguna }}</td>
                        <!-- <td>Offline</td> -->
                        <td>{{ $item->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </a>
    @endforeach
</div>
@endsection