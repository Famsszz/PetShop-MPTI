@extends('layouts.main')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Penitipan Hewan <a href="/penitipan-page"><img src="/images/animal-care_6915431.png" alt="" height="30px;" style="margin-left: 10px;"></a></h3>
        <div class="boxx">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    @if (session('success'))
                    <div class="alert alert-danger">
                        {{ session('success') }}
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
                        <td class="align-middle text-center">
                        @if($pntpn->status == 'Menunggu_Pembayaran')
                        Menunggu Pembayaran
                        @else
                        {{ $pntpn->status }}
                        @endif
                        </td>
                        <td class="align-middle text-center">
                            @if($pntpn->status == 'Gagal')
                            <form action="/penitipan/{{ $pntpn->ID_Penitipan }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')">Hapus</button>
                            </form>
                            @else
                            <div class="d-flex justify-content-center">
                                <!-- <a href="/bayar"><button class="badge bg-warning border-0" style="margin-right: 5px;">Bayar</button></a> -->
                                <form action="/penitipan/{{ $pntpn->ID_Penitipan }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')">Hapus</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection