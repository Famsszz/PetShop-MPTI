@extends('layouts.main')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Keranjang Barang
            <a href="/pengambilan-page" style="color:black; margin-left:10px;"><i class="bi bi-box-fill"></a></i>
        </h3>
        <div class="boxx">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="mb-3">
                        <form action="/keranjang/terima-semua" method="post" onsubmit="return validateForm()" style="margin-left: -231px;">
                            @csrf
                            @foreach($keranjangss as $item)
                            <input type="hidden" name="ID_Barang[]" value="{{ $item->ID_Barang }}">
                            <input type="hidden" name="ID_Pengguna[]" value="{{ Auth::user()->ID_Pengguna }}">
                            <input type="hidden" name="ID_Kategori[]" value="{{ $item->ID_Kategori }}">
                            <input type="hidden" name="Nama_Barang[]" value="{{ $item->Barang }}">
                            <input type="hidden" name="Nama_Pengguna[]" value="{{ Auth::user()->Nama_Pengguna }}">
                            <input type="hidden" name="Peran[]" value="{{ Auth::user()->Peran }}">
                            <input type="hidden" name="Nama_Kategori[]" value="{{ $item->Nama_Kategori }}">
                            <input type="hidden" name="Harga_Satuan[]" value="{{ $item->Harga_Satuan }}">
                            <input type="hidden" name="gambar[]" value="{{ $item->gambar }}">
                            <input type="hidden" name="status[]" value="Menunggu_Pembayaran">
                            <input type="hidden" name="deskripsi[]" value="{{ $item->deskripsi }}">
                            <input type="hidden" name="quantity[]" value="{{ $item->jumlah_stok_dipesan }}">
                            @endforeach
                            <button class="btn btn-success" style="background-color: rgb(53, 200, 53); border-radius:0; border: 1px solid #D5D9DD; border-bottom:none;">Beli Semua</button>
                        </form>
                        <script>
                            function validateForm() {
                                // Mengambil jumlah barang yang dibeli
                                var jumlahBarang = {{ count($keranjangss) }};
                                
                                // Memeriksa apakah tidak ada barang yang dibeli
                                if (jumlahBarang === 0) {
                                    alert('Tidak ada barang yang dibeli. Silakan pilih barang terlebih dahulu.');
                                    return false; // Mencegah pengiriman formulir jika tidak ada barang yang dibeli
                                }
                        
                                // Konfirmasi sebelum mengirim formulir
                                return confirm('Apakah Anda yakin ingin menerima semua barang ini?');
                            }
                        </script>
                    </div>
                    <tr>
                        <th width="60px">No</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Detail Produk</th>
                        <th>Harga</th>
                        <th>Banyak</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                        <td class="align-middle text-center">{{ $krjg->jumlah_stok_dipesan }}</td>
                        <td class="align-middle text-center">
                            @if($krjg->status == 'Menunggu_Pembayaran')
                            Menunggu Pembayaran
                            @else
                            {{ $krjg->status }}
                            @endif
                        </td>
                        <td class="align-middle text-center">
                            @if($krjg->status == 'Gagal')
                            <form action="/keranjang/{{ $krjg->ID_Keranjang }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')">Hapus</button>
                            </form>
                            @else
                                <!-- <a href="/bayar"><button class="badge bg-warning border-0" style="margin-right: 5px;">Bayar</button></a> -->
                                <form action="/keranjang/{{ $krjg->ID_Keranjang }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')">Hapus</button>
                                </form>
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