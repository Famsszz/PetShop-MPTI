@extends('layouts.mainkasir')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh; width:700px;">
        <h3>Penitipan Hewan <a href="/penitipan-kasir"><img src="/images/animal-care_6915431.png" alt="" height="30px;"
                    style="margin-left: 10px;"></a></h3>

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
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $penggunaTerlihat = [];
                    @endphp
                    @foreach ($penitipan as $pntpn)
                    @if (!in_array($pntpn->Nama_Pengguna, $penggunaTerlihat))
                    <tr>
                        <td class="align-middle text-center">{{ $pntpn->Nama_Pengguna }}</td>
                        <td class="align-middle text-center" style="border: none;"> {{ $pntpn->status }}</td>
                        <td class="align-middle text-center"> {{ $pntpn->Tanggal }} </td>
                        <td class="align-middle text-center"><a
                                href="/detailpenitipan/{{$pntpn->Nama_Pengguna}}">Detail</a></td>
                    </tr>
                    @php
                    $penggunaTerlihat[] = $pntpn->Nama_Pengguna;
                    @endphp
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection