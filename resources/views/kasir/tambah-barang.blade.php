@extends('layouts.mainkasir')
@section('container')

    <div class="container" style="min-height: 100vh;">
        <h3>Tambah Data Barang</h3>
        <div class="box">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form action="/tambahbarangdatabase" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    @if (isset($kategori) && count($kategori) > 0)
                        <select name="kategori" id="kategori" class="input-control" onChange="getSubCat(this.value);"
                            required>
                            <option value="">--Pilih--</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->ID_Kategori }}">{{ $k->Nama_Kategori }}</option>
                            @endforeach
                        </select>
                    @else
                        <p>Tidak ada kategori yang tersedia.</p>
                    @endif
                </div>

                <label for="nama" style="text-align: left; display: block; margin-bottom: 5px;">Nama Barang:</label>
                <input type="text" name="nama" id="nama" class="input-control" placeholder="Nama Barang"
                    required>

                <label for="harga" style="text-align: left; display: block; margin-bottom: 5px;">Harga:</label>
                <input type="number" name="harga" id="harga" class="input-control" placeholder="Harga" required>

                <label for="gambar" style="text-align: left; display: block; margin-bottom: 5px;">Gambar:</label>
                <input type="file" name="gambar" id="gambar" class="input-control" required>

                <label for="stok" style="text-align: left; display: block; margin-bottom: 5px;">Stok:</label>
                <input type="number" name="stok" id="stok" class="input-control" placeholder="Stok" required>

                <label for="deskripsi" style="text-align: left; display: block; margin-bottom: 5px;">Deskripsi</label>
                <textarea name="deskripsi" placeholder="deskripsi" class="input-control" cols="30" rows="10"></textarea>

                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
        </div>
    </div>


@endsection
