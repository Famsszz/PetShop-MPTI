@extends('layouts.mainkasir')
@section('container')
        @if (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-4" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    <div class="section">
        <div class="container" style="min-height: 100vh;">
            <h3>Edit Data Barang</h3>
            <div class="box">
                <form action="{{ route('edit.barang', ['idb' => $barang->ID_Barang]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @if (isset($kategori) && count($kategori) > 0)
                            <select name="kategori" id="kategori" class="input-control" onChange="getSubCat(this.value);"
                                required>
                                <option value="">--Pilih--</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->ID_Kategori }}" {{ $barang->ID_Kategori === $k ->ID_Kategori ? 'selected' :'' }}>{{ $k->Nama_Kategori }}</option>
                                @endforeach
                            </select>
                        @else
                            <p>Tidak ada kategori yang tersedia.</p>
                        @endif
                    </div>

                <input type="text" name="nama" class="input-control" placeholder="Nama Barang" value="{{ $barang->Nama_Barang }}">
                <input type="number" name="harga" class="input-control" placeholder="Harga" value="{{ $barang->Harga_Satuan }}">
                <input type="number" name="stok" id="stok" class="input-control" placeholder="Stok" value="{{ $barang->Stok_Jual}}" >
                @if ($barang->gambar)
                    <img src="{{ asset('berkas_ujis/' . $barang->gambar) }}" alt="Gambar Stok" width="100" height="100">
                @endif
                <input type="file" name="gambar" id="gambar" class="input-control">
                <select name="status" id="status" class="input-control">
                    <option value="">--Pilih--</option>
                    @foreach ($status as $s)
                        <option value="{{ $s }}" {{ $barang->Status === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                <textarea name="deskripsi" placeholder="deskripsi" class="input-control" cols="30" rows="10">{{ $barang->deskripsi }}</textarea>

                <input type="submit" name="submit" value="Submit" class="btn">           
                </form>
            </div>
        </div>
    </div>
@endsection