@extends('layouts.mainkasir')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3 style="color:black; margin-left:10px;">Penitipan Hewan</i></h3>
        <div class="boxx">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <tr>
                        <th>Gambar</th>
                        <th width="60px">No</th>
                        <th>ID Transaksi</th>
                        <th>Jenis Layanan</th>
                        <th>Nama</th>
                        <th>Lama</th>
                        <th>Batas Pengambilan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penitipan as $index => $p)
                    <tr>
                        <td>
                            <div class="boxImageKeranjang mx-auto">
                                <img class="img-fluidd-tes" src="{{ asset('berkas_ujis/' . $p->gambar) }}" style="object-fit: contain;">
                            </div>
                        </td>
                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                        <td class="align-middle text-center">{{ $p->ID_Transaksi }}</td>
                        <td class="align-middle text-center">{{ $p->Jenis_Layanan }}</td>
                        <td class="align-middle text-center">{{ $p->Nama_Hewan }}</td>
                        <td class="align-middle text-center">{{ $p->Lama_Hari }}</td>
                        <td class="align-middle text-center" id="batasPengambilan{{ $index }}"></td>
                        <td class="align-middle text-center">
                            <form action="/penitipan/{{ $p->ID_Penitipan }}" method="POST">
                                @csrf
                                <button class="badge bg-success border-0" onclick="return confirm('Apakah Anda yakin Pengguna sudah mengambilnya?')">Terima</button>
                            </form>
                        </td>
                        <script>
                            // Hitung tanggal 3 hari ke depan dari sekarang
                            var batasPengambilan = new Date();
                            batasPengambilan.setDate(batasPengambilan.getDate() + 1);

                            // Format tanggal ke dalam string
                            var formattedDate = batasPengambilan.toISOString().split('T')[0];

                            // Tampilkan hasilnya di elemen dengan ID yang sesuai
                            document.getElementById("batasPengambilan{{ $index }}").innerHTML = formattedDate;
                        </script>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection