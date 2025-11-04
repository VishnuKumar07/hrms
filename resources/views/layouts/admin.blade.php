<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Human Resource Management Software</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        body {
            background-color: #F3F4F6;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: linear-gradient(180deg, #004433, #006644);
            color: white;
            position: fixed;
            padding: 25px 15px;
            overflow-y: auto;
        }

        .sidebar-logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .menu-item {
            padding: 5px 5px 5px 30px;
            display: flex;
            align-items: center;
            border-radius: 6px;
            cursor: pointer;
            margin-bottom: 4px;
            transition: 0.2s;
            color: white;
            text-decoration: none;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
            color: white;
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.30);
            font-weight: 600;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .navbar-custom {
            margin-left: 240px;
        }

        .menu-item[aria-expanded="true"] .arrow-icon {
            transform: rotate(90deg);
            transition: 0.3s;
        }

        .arrow-icon {
            transition: 0.3s;
        }

        .table th,
        table td {
            text-align: center !important;
        }

        #fullPageLoader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .center_loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #0d6efd;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }


        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #0d6efd;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            margin: auto;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .model_loader {
            width: 60px;
            aspect-ratio: 4;
            background: radial-gradient(circle closest-side, #000 90%, #0000) 0/calc(100%/3) 100% space;
            clip-path: inset(0 100% 0 0);
            animation: l1 1s steps(4) infinite;
        }

        @keyframes l1 {
            to {
                clip-path: inset(0 -34% 0 0)
            }
        }
    </style>
</head>

<body>
    <div id="fullPageLoader" style="display:none;">
        <div class="center_loader"></div>
    </div>

    <div class="sidebar">
        <div class="sidebar-logo"></div>
        @include('partials.menu')
    </div>

    <nav class="bg-white shadow-sm navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-shield-lock"></i> Change Password
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content">
        @yield('content')
    </main>

    @yield('scripts')

</body>

</html>
