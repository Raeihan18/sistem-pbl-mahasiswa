<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem PBL Mahasiswa</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Bootstrap 5 JS (Popper & Bundle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom fonts for this template -->
    <link href="/templet-admin/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/templet-admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/templet-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom Hover Sidebar (item saja + shadow + perbaikan overflow) -->
    <style>
        /* Efek hover lembut pada item sidebar */
        .sidebar .nav-item .nav-link {
            border-radius: 8px;
            margin: 4px 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-item .nav-link:hover {
            background-color: #ffffff !important;
            color: #4e73df !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* Ubah warna ikon saat hover */
        .sidebar .nav-item .nav-link:hover i {
            color: #4e73df !important;
        }

        /* Saat item aktif */
        .sidebar .nav-item .nav-link.active {
            background-color: #ffffff !important;
            color: #4e73df !important;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        /* === Tambahan agar teks sidebar tidak keluar === */
        .sidebar {
            width: 230px;
            /* Batasi lebar sidebar */
            overflow-x: hidden;
            /* Sembunyikan horizontal scroll */
        }

        .sidebar .nav-item .nav-link span {
            display: inline-block;
            max-width: 140px;
            /* Batasi teks */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            /* Tambahkan "..." jika panjang */
            vertical-align: middle;
        }

        .sidebar .nav-item .nav-link i {
            width: 25px;
            text-align: center;
        }

        /* === End tambahan === */
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/pembimbing/dashboard">
                <div class="sidebar-brand-icon">
                    <img src="/image/logo.png" style="width: 50px" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">SISTEM PBL MAHASISWA</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('pembimbing/dashboard') ? 'active' : '' }}" href="/pembimbing/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Nav Item - Mata Kuliah -->
            <li class="nav-item  ">
                <a class="nav-link {{ Request::is('pembimbing/mata-kuliah*') ? 'active' : '' }}" href="/pembimbing/mata-kuliah">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Kuliah</span>
                </a>
            </li>

            <!-- Nav Item - Mahasiswa -->
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('pembimbing/mahasiswa*') ? 'active' : '' }}" href="/pembimbing/mahasiswa">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Mahasiswa</span>
                </a>
            </li>

            <!-- Nav Item - Kelompok -->
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('pembimbing/kelompok*') ? 'active' : '' }}" href="/pembimbing/kelompok">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Kelompok</span>
                </a>
            </li>

            <!-- Nav Item - Nilai Mahasiswa -->
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('pembimbing/nilai-mahasiswa*') ? 'active' : '' }}" href="/pembimbing/nilai-mahasiswa">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Nilai Mahasiswa</span>
                </a>
            </li>

            <!-- Nav Item - Nilai Kelompok -->
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('pembimbing/nilai-kelompok*') ? 'active' : '' }}" href="/pembimbing/nilai-kelompok">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Nilai Kelompok</span>
                </a>
            </li>


            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{$authUser->nama ?? 'pembimbing'}}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('storage/potoprofil/' . ($profil->potoprofil ?? 'default-avatar.png')) }}">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/pembimbing/profil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistem PBL Mahasiswa 2025</span>
                    </div>
                </div>
            </footer>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
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
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')

    <!-- Bootstrap core JavaScript-->
    <script src="/templet-admin/vendor/jquery/jquery.min.js"></script>
    <script src="/templet-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/templet-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/templet-admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/templet-admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/templet-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/templet-admin/js/demo/datatables-demo.js"></script>
</body>

</html>
