@extends('layouts.main')
@section('container')

{{-- detail produknya --}}
<div class="container-fluid py-5">
    <div class="container" style="min-height: 100vh;">
        <div class="row">
            <a href="{{ $viewbarang->Nama_Kategori == 'Alat' ? '/alat' : '/makanan' }}" style="margin-left:640px; margin-top: -48px; color:black">
                <i class="bi bi-arrow-left-square-fill" style="font-size:40px;"></i>
            </a>
            <div class="col-md-4">
                <img class="img-fluid" src="{{ asset('berkas_ujis/' . $viewbarang->gambar) }}" style="object-fit: contain;">
            </div>
            <div class="col-md-7">
                <div class="card mt-5 tes">

                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <h1 class="card-title"> {{ $viewbarang->Nama_Barang }} </h1>
                        <table class="fs-5">

                            <tr class=" text-left">
                                <td>
                                    Kategori
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $viewbarang->Nama_Kategori }}
                                </td>
                            </tr>
                            <tr class=" text-left">
                                <td>Detail Produk </td>
                                <td> : </td>
                                <td> {{ $viewbarang->deskripsi }} </td>
                            </tr>
                            <tr class=" text-left">
                                <td>
                                    Harga
                                </td>
                                <td> : </td>
                                <td style="color: rgb(123, 117, 117);">
                                    <strong> {{ $viewbarang->Harga_Satuan }} </strong>
                                </td>
                            </tr>
                            <tr class=" text-left">
                                <td>Stok tersisa </td>
                                <td> : </td>
                                <td><strong> {{ $viewbarang->Stok_Jual }} </strong></td>
                            </tr>
                            <tr class=" text-left">
                                <td>
                                    @if (Route::has('login'))
                                    @auth
                                    <script>
                                        function decreaseQuantity() {
                                            var quantity = document.getElementById('quantity');
                                            if (quantity.value > 1) {
                                                quantity.value--;
                                            }
                                        }

                                        function increaseQuantity() {
                                            var quantity = document.getElementById('quantity');
                                            var maxStock = parseInt('{{ $viewbarang->Stok_Jual }}');

                                            if (quantity.value < maxStock) {
                                                quantity.value++;
                                            }
                                        }
                                    </script>
                                    <button id="decrease" onclick="decreaseQuantity()" class="plusminus">-</button>
                                    <input id="quantity" name="quantity" value="0" min="0" class="tpm" oninput="disableArrowKeys(event)" onkeypress="disableArrowKeys(event)">
                                    <button id="increase" onclick="increaseQuantity()" class="plusminus">+</button>

                                    <form action="/keranjang" method="post" onsubmit="prepareForm(event)">
                                        @csrf
                                        <input type="submit" value="Masukkan Keranjang" class="btn" style="margin-top: 13px;">
                                        <input type="hidden" name="ID_Barang" value=" {{ $barangJuals->ID_Barang }}">
                                        <input type="hidden" name="ID_Pengguna" value=" {{ Auth::user()->ID_Pengguna }}">
                                        <input type="hidden" name="ID_Kategori" value=" {{ $barangJuals->ID_Kategori }}">
                                        <input type="hidden" name="Nama_Barang" value=" {{ $barangJuals->Nama_Barang }}">
                                        <input type="hidden" name="Nama_Pengguna" value=" {{ Auth::user()->Nama_Pengguna }}">
                                        <input type="hidden" name="Peran" value=" {{ Auth::user()->Peran }}">
                                        <input type="hidden" name="Nama_Kategori" value=" {{ $barangJuals->kategori->Nama_Kategori }}">
                                        <input type="hidden" name="Harga_Satuan" value=" {{ $barangJuals->Harga_Satuan }}">
                                        <input type="hidden" name="gambar" value=" {{ $barangJuals->gambar }}">
                                        <input type="hidden" name="status" value="Keranjang">
                                        <input type="hidden" name="deskripsi" value=" {{ $barangJuals->deskripsi }}">
                                        <input type="hidden" id="hiddenQuantity" name="quantity" value="">
                                    </form>

                                    <script>
                                        function prepareForm(event) {
                                            var quantityValue = document.getElementById('quantity').value;
                                            document.getElementById('hiddenQuantity').value = quantityValue;
                                        }
                                    </script>

                                </td>
                            </tr>
                                @else
                                <a href="{{ route('login') }}"><input type="submit" value="Masukkan Keranjang" class="btn"></a>
                                
                                @endauth
                    </div>
                    @endif
                    </td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection