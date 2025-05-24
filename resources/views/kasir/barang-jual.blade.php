@extends('layouts.mainkasir')
@section('container')
<h3>Data Barang Jual</h3>
<div class="row" style="margin:0; padding:0">
    <div class="col-md-8" style="margin-left: 40px;">
        <div class="section">
            <div class="box" style="opacity: 0.9;">
                <div style="display:flex; justify-content:center; align-items: center;">
                    <form action="{{ route('barang.search') }}" method="GET" class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="Cari Barang.."
                            aria-label="Search" style="min-width: 500px; margin-bottom: 15px;">
                        <button class="btn btn-outline-success" type="submit" style="height: 35px;">Search</button>
                    </form>
                </div>
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

                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $currentPage = $barangJuals->currentPage();
                        $perPage = $barangJuals->perPage();
                        $totalItems = $barangJuals->total();
                        $startingNumber = ($currentPage - 1) * $perPage + 1;
                        @endphp
                        @foreach ($barangJuals as $dabar)
                        @php
                        $currentID = 'quantity_' . $dabar->ID_Barang;
                        @endphp
                        <tr>
                            <td>{{ $startingNumber++ }}</td>
                            <td>{{ $dabar->Kategori->Nama_Kategori }}</td>
                            <td>{{ $dabar->Nama_Barang }}</td>
                            <td>{{ $dabar->Harga_Satuan }}</td>
                            <td><img src="{{ asset('berkas_ujis/' . $dabar->gambar) }}" alt="Gambar Stok" width="100"
                                    height="100"></td>
                            <td>{{ $dabar->Status }}</td>
                            <td>{{ $dabar->deskripsi }}</td>
                            <td>{{ $dabar->Stok_Jual }}</td>
                            <td>
                                <script>
                                    function disableArrowKeys(event) {
                                        // Add your logic for arrow key handling here
                                    }

                                    function decreaseQuantity(id) {
                                        var quantity = document.getElementById('quantity_' + id);
                                        if (quantity.value > 1) {
                                            quantity.value--;
                                        }
                                    }

                                    function increaseQuantity(id, maxStock) {
                                        var quantity = document.getElementById('quantity_' + id);
                                        // Assuming maxStock is the available stock for the item
                                        if (parseInt(quantity.value) + 1 <= maxStock) {
                                            quantity.value++;
                                        } else {
                                            alert("Stok tidak tersedia");
                                        }
                                    }

                                    function prepareForm(id) {
                                        var quantityValue = document.getElementById('quantity_' + id).value;
                                        document.getElementById('hiddenQuantity_' + id).value = quantityValue;
                                    }
                                </script>
                                <button onclick="decreaseQuantity('{{ $dabar->ID_Barang }}')"
                                    class="plusminus">-</button>
                                <input id="quantity_{{ $dabar->ID_Barang }}" name="quantity" value="0" min="0"
                                    class="tpm" oninput="disableArrowKeys(event)" onkeypress="disableArrowKeys(event)">
                                <button onclick="increaseQuantity('{{ $dabar->ID_Barang }}', '{{ $dabar->Stok_Jual }}')"
                                    class="plusminus">+</button>


                                <form action="/keranjangKhususkasir" method="post"
                                    onsubmit="prepareForm('{{ $dabar->ID_Barang }}')">
                                    @csrf
                                    <input type="submit" value="Masukkan Keranjang" class="btn"
                                        style="margin-top: 13px;">
                                    <!-- <input type="hidden" name="ID_Transaksi" value="1"> -->
                                    <input type="hidden" name="ID_Barang" value="{{ $dabar->ID_Barang }}">
                                    <input type="hidden" name="ID_Pengguna" value="{{ Auth::user()->ID_Pengguna }}">
                                    <input type="hidden" name="ID_Kategori" value="{{ $dabar->ID_Kategori }}">
                                    <input type="hidden" name="Nama_Barang" value="{{ $dabar->Nama_Barang }}">
                                    <input type="hidden" name="Nama_Pengguna" value="{{ Auth::user()->Nama_Pengguna }}">
                                    <input type="hidden" name="Peran" value="{{ Auth::user()->Peran }}">
                                    <input type="hidden" name="Nama_Kategori"
                                        value="{{ $dabar->kategori->Nama_Kategori }}">
                                    <input type="hidden" name="Harga_Satuan" value="{{ $dabar->Harga_Satuan }}">
                                    <input type="hidden" name="gambar" value="{{ $dabar->gambar }}">
                                    <input type="hidden" name="status" value="Offline">
                                    <input type="hidden" name="deskripsi" value="{{ $dabar->deskripsi }}">
                                    <input type="hidden" id="hiddenQuantity_{{ $dabar->ID_Barang }}" name="quantity"
                                        value="">
                                </form>

                                <script>
                                    function prepareForm(id) {
                                        var quantityValue = document.getElementById('quantity_' + id).value;
                                        document.getElementById('hiddenQuantity_' + id).value = quantityValue;
                                    }
                                </script>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $barangJuals->links() }}
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top: -2.5px; margin-left:-5px;">
        <form action="/datapesanankasir/terima-semua" method="post" onsubmit="return validateForm()" style="margin-left: -231px;">
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
            <input type="hidden" name="status[]" value="Offline">
            <input type="hidden" name="deskripsi[]" value="{{ $item->deskripsi }}">
            <input type="hidden" name="quantity[]" value="{{ $item->jumlah_stok_dipesan }}">
            @endforeach
            <button class="btn btn-success"
                style="background-color: rgb(53, 200, 53); border-radius:0; border: 1px solid #D5D9DD; border-bottom:none;">Terima
                Semua</button>
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
                return confirm('Apakah Anda yakin ingin menerima semua penitipan ini?');
            }
        </script>
        <table border="1" cellspacing="0" class="table table2">
            <thead>
                <tr style="font-size: 15px;">
                    <th width="60px">No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Banyak</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalKeseluruhan = 0;
                @endphp
                @foreach ($keranjang as $krjg)
                <tr>
                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                    <td>
                        <div class="boxImageKeranjang mx-auto">
                            <img class="img-fluidd-tes" src="{{ asset('berkas_ujis/' . $krjg->gambar) }}"
                                style="object-fit: contain;">
                        </div>
                    </td>
                    <td class="align-middle text-center">{{ $krjg->Barang }}</td>
                    <td class="align-middle text-center">{{ $krjg->Harga_Satuan }}</td>
                    @php
                    $subtotal = $krjg->Harga_Satuan * $krjg->jumlah_stok_dipesan;
                    $totalKeseluruhan += $subtotal;
                    @endphp
                    <td class="align-middle text-center">{{ $krjg->jumlah_stok_dipesan }}</td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-between">
                            <form action="/datapesanankasir/tolak/{{ $krjg->ID_Keranjang }}" method="post"
                                onsubmit="return confirm('Apakah Anda yakin ingin menolak pesanan ini?')">
                                @csrf
                                <button class="badge bg-danger border-0">Batal</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection