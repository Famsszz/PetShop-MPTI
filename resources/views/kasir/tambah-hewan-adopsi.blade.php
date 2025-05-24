@extends('layouts.mainkasir')
@section('container')

    <div class="container" style="min-height: 100vh;">
        <h3>Tambah Data Hewan</h3>
        <div class="box">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

            <form action="/tambahhewandatabase" method="POST" enctype="multipart/form-data">
                @csrf
               <div class="form-group">
                   <input type="hidden" name="kategori" value="{{ $kategoriHewan->ID_Kategori }}">
                   <label for="nama">Nama Hewan:</label>
                   <input type="text" name="nama" id="nama" class="input-control" placeholder="Nama Hewan" required>
               
                   <label for="harga">Harga:</label>
                   <input type="number" name="harga" id="harga" class="input-control" placeholder="Harga" required>
               
                   <label for="gambar">Gambar:</label>
                   <input type="file" name="gambar" id="gambar" class="input-control" required>
               
                   <label for="stok">Stok:</label>
                   <input type="number" name="stok" id="stok" class="input-control" placeholder="Stok" required>
               
                   <label for="deskripsi">Deskripsi</label>
                   <textarea name="deskripsi" placeholder="deskripsi" class="input-control" cols="30" rows="10"></textarea>

                   <input type="submit" name="submit" value="Submit" class="btn">  
               </div>     
            </form>
        </div>
    </div>
@endsection
