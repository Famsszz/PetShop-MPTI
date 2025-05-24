@extends('layouts.main')
@section('container')
<div class="container-fluid" style="border-radius: 0%; min-height:100vh;">
<a href="/"  style="margin-left:1280px; color:black"><i class="bi bi-arrow-left-square-fill" style="font-size:40px;"></i></a>
  <div class="row row-cols-1 row-cols-md-4 g-4" style="padding: 50px; padding-top:10px">
    @foreach ($adopsi as $item)
    <div class="col">
      <a href="/detail-hewan/{{ $item->ID_Barang }}" style="text-decoration: none;">
        <div class="card h-100">
          <img src="{{ asset('berkas_ujis/' . $item->gambar) }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{ $item->Nama_Hewan }}</h5>
            <p class="card-text">{{ $item->deskripsi }}</p>
          </div>
        </div>
      </a>
    </div>
    @endforeach

  </div>
</div>
@endsection