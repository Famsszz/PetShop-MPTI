@extends('layouts.mainkasir')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Penitipan Hewan <a href="/penitipan-kasir"><img src="/images/animal-care_6915431.png" alt="" height="30px;" style="margin-left: 10px;"></a></h3>
        <div class="boxx">
        <!-- <div class="mb-3">
                <form action="/datapesananpenitipan/terima-semua" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menerima semua penitipan ini?')">
                    @csrf
                    <button class="btn btn-success">Terima Semua</button>
                </form>
            </div> -->
            <div class="mb-3">
                <form action="/datapenitipankasir/terima" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menerima semua pesanan ini?')">
                    @csrf
                    @if($penitipan->first())
                    <input type="hidden" name="ID_Transaksi" value="{{ $penitipan->first()->ID_Transaksi }}">
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
                        <th>Nama Pemilik</th>
                        <th>Nama Hewan</th>
                        <th>Tanggal</th>
                        <th>Lama Hari Penitipan</th>
                        <th>Jenis Layanan</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penitipan as $pntpn)
                    <tr>
                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="boxImageKeranjang mx-auto">
                                <img class="img-fluidd-tes" src="{{ asset('berkas_ujis/' . $pntpn->gambar) }}" style="object-fit: contain;">
                            </div>
                        </td>
                        <td class="align-middle text-center">{{ $pntpn->Nama_Pengguna }}</td>
                        <td class="align-middle text-center"> {{ $pntpn->Nama_Hewan }} </td>
                        <td class="align-middle text-center"> {{ $pntpn->Tanggal }} </td>
                        <td class="align-middle text-center">{{ $pntpn->Lama_Hari }}</td>
                        <td class="align-middle text-center"> {{ $pntpn->Jenis_Layanan }} </td>
                        <td class="align-middle text-center"> {{ $pntpn->Harga }}</td>
                        <td class="align-middle text-center" style="border: none;"> {{ $pntpn->status }}</td>
                        <td class="align-middle text-center">
                        <div class="d-flex justify-content-center">

                            <form action="/datapenitipankasir/tolak/{{ $pntpn->ID_Penitipan }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menolak penitipan ini?')">
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