@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container-fluid" style="min-height: 100vh;">
        <h3>Data Log transaksi</h3>
        <div class="box" style="opacity: 0.9;">
            <!-- <p><a href="tambah-produk.php">Tambah Data</a></p> -->
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>ID_Transaksi</th>
                        <th>ID_Barang</th>
                        <th>ID_StokMasuk</th>
                        <th>Aksi</th>
                        <th>Uang_Masuk_New</th>
                        <th>Uang_Masuk_Old</th>
                        <th>Uang_keluar_New</th>
                        <th>Uang_keluar_Old</th>
                        <th>Uang_New</th>
                        <th>Uang_Old</th>
                        <th>Diperbarui</th>
                    </tr>
                    <tr>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection