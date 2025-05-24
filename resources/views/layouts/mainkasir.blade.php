<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="/bootstrap-5.3.2-dist/css/bootstrap.css">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
    <script src="{{ asset('asset_index/bootstrap/bootstrap.min.css') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.js') }}"></script>
    <link href="{{ asset('asset/sb-admin-2.min.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link href="{{ asset('asset/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="background-color: black;">


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('kasirdashboard') ? 'active' : '' }}">

                <div class="container-fluid">
                    <a class="navbar-brand" href="/kasirdashboard">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="92px"
                            class="d-inline-block align-text-top">
                    </a>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Kasir
            </div>
            <!-- Nav Item -Akun -->
            <li class="nav-item {{ request()->is('datastokkasir') ? 'active' : '' }}">
                <a class="nav-link" href="/datastokkasir">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data-Stok</span></a>
            </li>
            <!-- Nav Item -Beritas -->
            <li class="nav-item {{ request()->is('datapesanankasir') ? 'active' : '' }}">
                <a class="nav-link" href="/datapesanankasir">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Pesanan-Barang</span></a>
            </li>
            <!-- Nav Item -komen -->
            <li class="nav-item {{ request()->is('datapenitipankasir') ? 'active' : '' }}">
                <a class="nav-link" href="/datapenitipankasir">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Pesanan-Penitipan</span></a>
            </li>
            <!-- Nav Item -Tambah Berita -->
            <li class="nav-item {{ request()->is('databarang') ? 'active' : '' }}">
                <a class="nav-link" href="/databarang">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data-Barang</span></a>
            </li>
            <!-- Nav Item -Tambah Akun -->
            <li class="nav-item {{ request()->is('datahewanadopsi') ? 'active' : '' }}">
                <a class="nav-link" href="/datahewanadopsi">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data-Hewan-Adopsi</span></a>
            </li>

            <li class="nav-item {{ request()->is('barangjual') ? 'active' : '' }}">
                <a class="nav-link" href="/barangjual">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Barang-Jual</span></a>
            </li>
            <!-- Nav Item -profile -->
            <li class="nav-item {{ request()->is('tambahpenitipan') ? 'active' : '' }}">
                <a class="nav-link" href="/tambahpenitipan">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Tambah-Penitipan</span></a>
            </li>

            <li class="nav-item {{ request()->is('list-faktur') ? 'active' : '' }}">
                <a class="nav-link" href="/list-faktur">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>List-Faktur</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle">
                    <>
                </button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            @include('partials.navbarkasir')
            <div id="content">

                <!-- Topbar -->
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <div class="container-fluid text-center"
                    style="margin: 0; padding: 0; background-color: rgba(255, 255, 255, 0.4); background-image: url('{{ asset('images/jejakkaki.png') }}'); background-size: cover;">
                    @yield('container')
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kelompok 5 MPTI 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <strong>^</strong>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- Bootstrap core JavaScript-->

    <script src="{{ asset('asset/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('asset/sb-admin-2.min.js') }}"></script>

</body>

</html>