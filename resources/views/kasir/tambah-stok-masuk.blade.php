@extends('layouts.mainkasir')
@section('container')

    <div class="container" style="min-height: 100vh;">
        <h3>Tambah Stok Masuk</h3>
        <div class="box">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form action="/tambahstokdb" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nabarang">Nama Barang:</label>
                    @if (isset($nabarang) && count($nabarang) > 0)
                        <select name="nabarang" id="nabarang" class="input-control" onChange="getSubCat(this.value);"
                            required>
                            <option value="">--Pilih--</option>
                            @foreach ($nabarang as $nb)
                                <option value="{{ $nb->ID_Barang }}">{{ $nb->Nama_Barang }}</option>
                            @endforeach
                        </select>
                    @else
                        <p>Tidak ada Barang yang tersedia.</p>
                    @endif
                </div>

                <label for="stok" style="text-align: left; display: block; margin-bottom: 5px;">Stok:</label>
                <input type="number" name="stok" id="stok" class="input-control" placeholder="Stok" required min="1">                

                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
        </div>
    </div>


@endsection
