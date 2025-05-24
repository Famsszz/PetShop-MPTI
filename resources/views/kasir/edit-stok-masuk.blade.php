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
            <h3>Edit Data Stok Masuk</h3>
            <div class="box">
                {{-- @dd($stok) --}}
                <form action="{{ route('edit.stokmasuk', ['ids' => $stok->ID_StokMasuk, 'idb' => $barang ->ID_Barang]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nabarang">Nama Barang:</label>
                        @if (isset($nabarang) && count($nabarang) > 0)
                            <select name="nabarang" id="nabarang" class="input-control @error('nabarang') is-invalid @enderror" onChange="getSubCat(this.value);"
                                required>
                                <option value="">--Pilih--</option>
                                @foreach ($nabarang as $nb)
                                    <option value="{{ $nb->ID_Barang }}" {{ $barang->ID_Barang === $nb ->ID_Barang ? 'selected' :'' }}>{{ $nb->Nama_Barang }} </option>
                                @endforeach
                            </select>
                            @error('nabarang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <p>Tidak ada Barang yang tersedia.</p>
                        @endif
                    </div>    
                    {{-- @dd($barang->Stok_Masuk) --}}
                <input type="number" name="stok" id="stok" class="input-control @error('stok') is-invalid @enderror" placeholder="Stok" value = "{{ $stok->Stok_Masuk }}">
                @error('stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                @enderror
                <input type="submit" name="submit" value="Submit" class="btn">           
                </form>
            </div>
        </div>
    </div>
@endsection