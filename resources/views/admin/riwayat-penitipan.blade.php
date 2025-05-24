@extends('layouts.mainadmin')
@section('container')

<div class="section">
    <div class="container" style="min-height: 100vh;">
        <h3>Riwayat Penitipan</h3>
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
                        <th>ID Penitipan</th>
                        <th>Pengguna</th>
                        <th>Nama Hewan</th>
                        <th>Jenis Layanan</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Lama Penitipan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $currentPage = $penitipan->currentPage();
                    $perPage = $penitipan->perPage();
                    $totalItems = $penitipan->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                    @endphp
                    @foreach ($penitipan as $pntpn)
                    <tr>
                        <td class="align-middle text-center">{{ $startingNumber++ }}</td>
                        <td class="align-middle text-center"><img src="{{ asset('berkas_ujis/' . $pntpn->gambar) }}"
                                alt="" width="100" height="100"></td>
                        <td class="align-middle text-center">{{ $pntpn->ID_Penitipan }}</td>
                        <td class="align-middle text-center">{{ $pntpn->Nama_Pengguna }}</td>
                        <td class="align-middle text-center">{{ $pntpn->Nama_Hewan }}</td>
                        <td class="align-middle text-center">{{ $pntpn->Jenis_Layanan }}</td>
                        <td class="align-middle text-center">{{ $pntpn->Harga }}</td>
                        <td class="align-middle text-center">{{ $pntpn->Tanggal }}</td>
                        <td class="align-middle text-center">{{ $pntpn->Lama_Hari }} hari</td>
                        <td class="align-middle text-center">{{ $pntpn->status }}</td>
                        <td class="align-middle text-center">
                            <form action="/deletehistorypenitipan/{{ $pntpn->ID_Penitipan }}" method="post"
                                class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="confirmDelete()">Hapus</button>
                            </form>

                            <script>
                                function confirmDelete() {
                                    // First confirmation
                                    if (confirm('Apakah Anda yakin ingin menghapus riwayat penitipan ini?')) {
                                        // Second confirmation
                                        if (confirm('Peringatan: Tindakan ini akan menghapus data riwayat penitipan dari pelanggan sebelumnya!\nApakah Anda yakin ingin melanjutkan?')) {
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
            {{ $penitipan->links() }}
        </div>
    </div>
</div>
@endsection