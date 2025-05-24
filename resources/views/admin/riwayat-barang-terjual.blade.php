@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Data Barang Terjual</h3>
        <div class="box" style="opacity: 0.9;">
            <!-- <p><a href="tambah-produk.php">Tambah Data</a></p> -->
            <table border="1" cellspacing="0" class="table">
                <thead>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <tr>
                        <th width="60px">No</th>
                        <th>Gambar</th>
                        <th>ID Barang</th>
                        <th>Pengguna</th>
                        <th>Nama Kategori</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah Stok Dipesan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $currentPage = $terjual->currentPage();
                    $perPage = $terjual->perPage();
                    $totalItems = $terjual->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                    @endphp
                    @foreach ($terjual as $tjwl)
                    <tr>
                        <td class="align-middle text-center">{{ $startingNumber++ }}</td>
                        <td class="align-middle text-center"><img src="{{ asset('berkas_ujis/' . $tjwl->gambar) }}"
                                alt="" width="100" height="100"></td>
                        <td class="align-middle text-center">{{ $tjwl->ID_Barang }}</td>
                        <td class="align-middle text-center">{{ $tjwl->Pengguna }}</td>
                        <td class="align-middle text-center">{{ $tjwl->Nama_Kategori }}</td>
                        <td class="align-middle text-center">{{ $tjwl->Barang }}</td>
                        <td class="align-middle text-center">{{ $tjwl->Harga_Satuan }}</td>
                        <td class="align-middle text-center">{{ $tjwl->jumlah_stok_dipesan }}</td>
                        <td class="align-middle text-center">{{ $tjwl->status }}</td>
                        <td class="align-middle text-center">
                            <form action="/deletehistorybarang/{{ $tjwl->ID_barangjual }}" method="post"
                                class="d-inline" id="deleteForm">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="confirmDelete()">Hapus</button>
                            </form>

                            <script>
                                function confirmDelete() {
                                    // First confirmation
                                    if (confirm('Apakah Anda yakin ingin menghapus riwayat barang ini?')) {
                                        // Second confirmation
                                        if (confirm('Peringatan: Tindakan ini akan menghapus data riwayat barang yang telah dibeli pelanggan sebelumnya!\nApakah Anda yakin ingin melanjutkan?')) {
                                            // Proceed with form submission
                                            document.getElementById('deleteForm').submit();
                                        }
                                    }
                                }
                            </script>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $terjual->links() }}
        </div>
    </div>
</div>
@endsection