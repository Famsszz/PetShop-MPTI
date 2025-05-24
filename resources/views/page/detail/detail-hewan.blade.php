@extends('layouts.main')
@section('container')

{{-- detail produknya --}}
<div class="container-fluid py-5">
    <div class="container" style="min-height: 100vh;">
        <div class="row">
        <a href="/adopsi"  style="margin-left:640px; margin-top: -48px; color:black"><i class="bi bi-arrow-left-square-fill" style="font-size:40px;"></i></a>
            <div class="col-md-4">
                <img class="img-fluid" src="{{ asset('berkas_ujis/' . $viewhewan->gambar) }}" style="object-fit: contain;">
            </div>
            <div class="col-md-7">
                <div class="card mt-5 tes">
                    <div class="card-body">
                        <h1 class="card-title"> {{ $viewhewan->Nama_Hewan }} </h1>
                        <table class="fs-5">

                            <tr class=" text-left">
                                <td>
                                    Kategori
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $viewhewan->Nama_Kategori }}
                                </td>
                            </tr>
                            <tr class=" text-left">
                                <td>Detail Hewan </td>
                                <td> : </td>
                                <td> {{ $viewhewan->deskripsi }} </td>
                            </tr>
                            <tr class=" text-left">
                                <td>
                                    Harga
                                </td>
                                <td> : </td>
                                <td style="color: rgb(123, 117, 117);">
                                    <strong> {{ $viewhewan->Harga_Satuan }} </strong>
                                </td>
                            </tr>
                            <tr class=" text-left">
                                <td>Stok tersisa </td>
                                <td> : </td>
                                <td><strong> {{ $viewhewan->Stok_Jual }} </strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection