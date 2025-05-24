@extends('layouts.main')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3 style="color:black; margin-left:10px;">Pengambilan Barang</i></h3>
        <div class="boxx">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <tr>
                        <th width="60px">No</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Detail Produk</th>
                        <th>Banyak</th>
                        <th>Batas Pengambilan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengambilan as $index => $p)
                    <tr>
                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="boxImageKeranjang mx-auto">
                                <img class="img-fluidd-tes" src="{{ asset('berkas_ujis/' . $p->gambar) }}" style="object-fit: contain;">
                            </div>
                        </td>
                        <td class="align-middle text-center">{{ $p->Nama_Kategori }}</td>
                        <td class="align-middle text-center">{{ $p->Barang }}</td>
                        <td class="align-middle text-center">{{ $p->deskripsi }}</td>
                        <td class="align-middle text-center">{{ $p->jumlah_stok_dipesan }}</td>
                        <td class="align-middle text-center" id="batasPengambilan{{ $index }}"></td> <!-- Menambahkan indeks sebagai bagian dari ID -->
                        <script>
                            // Hitung tanggal 3 hari ke depan dari sekarang
                            var batasPengambilan = new Date();
                            batasPengambilan.setDate(batasPengambilan.getDate() + 3);

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