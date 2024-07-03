<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fishiden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('assets\css\style_new.css') }}">
    <style>
        .bg-hero {
            background-image: url("{{ \App\Helper\Utility::loadAsset('assets/img/bg-hero.jpg') }}");
            background-repeat: no-repeat, repeat;
            background-position: center;
            background-size: cover;
        }

        .bg-water {
            background-image: url("{{ \App\Helper\Utility::loadAsset('assets/img/bg-underwater.jpg') }}");
            background-repeat: no-repeat, repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
    @yield('css')
</head>

<body class="bg-dark">

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">
                <span class="fw-bold">Fishiden</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body align-items-center">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="{{\App\Helper\Utility::stateMenu(['home'],request())? '#about':(route('home').'#about')}}">
                                <div class="hstack justify-content-between align-items-center">
                                    <span>Apa itu Fishiden</span>
                                    <span class="material-symbols-rounded d-block d-lg-none">
                                        chevron_right
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{\App\Helper\Utility::stateMenu(['home'],request())? '#carakerja':(route('home').'#carakerja')}}">
                                <div class="hstack justify-content-between align-items-center">
                                    <span>Cara Kerja</span>
                                    <span class="material-symbols-rounded d-block d-lg-none">
                                        chevron_right
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{\App\Helper\Utility::stateMenu(['home'],request())? '#keahlian':(route('home').'#keahlian')}}">
                                <div class="hstack justify-content-between align-items-center">
                                    <span>Keahlian</span>
                                    <span class="material-symbols-rounded d-block d-lg-none">
                                        chevron_right
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('about')}}">
                                <div class="hstack justify-content-between align-items-center">
                                    <span>Tentang</span>
                                    <span class="material-symbols-rounded d-block d-lg-none">
                                        chevron_right
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('familyguide')}}">
                                <div class="hstack justify-content-between align-items-center">
                                    <span>Gallery</span>
                                    <span class="material-symbols-rounded d-block d-lg-none">
                                        chevron_right
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="hstack justify-content-between align-items-center">
                                    <span>Research</span>
                                    <span class="material-symbols-rounded">
                                        arrow_drop_down
                                    </span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item font-small" href="{{route('archive_publicaton')}}">
                                        <div class="hstack justify-content-between align-items-center">
                                            <span style="font-size: small;">Archive of scientific publications</span>
                                            <span class="material-symbols-rounded">
                                                chevron_right
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="hstack justify-content-between align-items-center">
                                    <span>News</span>
                                    <span class="material-symbols-rounded">
                                        arrow_drop_down
                                    </span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item font-small" href="{{route('news')}}">
                                        <div class="hstack justify-content-between align-items-center">
                                            <span>New Archive</span>
                                            <span class="material-symbols-rounded">
                                                chevron_right
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item font-small" href="#">
                                        <div class="hstack justify-content-between align-items-center">
                                            <span>Podcast</span>
                                            <span class="material-symbols-rounded">
                                                chevron_right
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item font-small" href="{{route('news_video')}}">
                                        <div class="hstack justify-content-between align-items-center">
                                            <span>Videos</span>
                                            <span class="material-symbols-rounded">
                                                chevron_right
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <!-- <li>
                                    <hr class="dropdown-divider">
                                </li> -->
                                <!-- <li>
                                    <a class="dropdown-item font-small" href="#">
                                        <div class="hstack justify-content-between align-items-center">
                                            <span>Blogs</span>
                                            <span class="material-symbols-rounded">
                                                chevron_right
                                            </span>
                                        </div>
                                    </a>
                                </li> -->
                                <!-- <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item font-small" href="#">
                                        <div class="hstack justify-content-between align-items-center">
                                            <span>Newsletter</span>
                                            <span class="material-symbols-rounded">
                                                chevron_right
                                            </span>
                                        </div>
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                    </ul>
                    @if (Session::get("userId"))
                    <a class="nav-link mb-2 mb-lg-0 align-items-center" href="{{route('dashboard.index')}}">
                        <div class="btn-custom-primary px-lg-4 mx-lg-3 w-100">DASHBOARD</div>
                    </a>
                    @else
                    <a class="nav-link mb-2 mb-lg-0 align-items-center" href="{{route('login.index')}}">
                        <div class="btn-custom-primary px-lg-4 mx-lg-3 w-100">LOGIN</div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
    
    <!-- Footer -->
    <section class="bg-primary text-light py-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-12 col-md-3">
                    <h3>Fishiden</h3>
                    <p class="mb-0">
                        AI Indentifikasi dan Klasifikasi ikan air tawar dan air laut asli Indonesia.
                    </p>
                </div>
                <div class="col-12 col-md-3">

                </div>
                <div class="col-12 col-md-3">
                    <h5>Quick Link</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a class="text-primary link-underline link-underline-opacity-0" href="https://www.fishbase.se/">FishBase</a>
                        </li>
                        <li class="list-group-item">
                            <a class="text-primary link-underline link-underline-opacity-0" href="https://www.iucnredlist.org/">The IUCN Red List of Threatened SpeciesTM</a>
                        </li>
                        <li class="list-group-item">
                            <a class="text-primary link-underline link-underline-opacity-0" href="https://www.ncbi.nlm.nih.gov/">NCBI (National Center for Biotechnology Information)</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <h5>Contact Us</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a class="text-primary link-underline link-underline-opacity-0" href="mailto:rifkimunandar13@gmail.com">
                                Email: rifkimunandar13@gmail.com
                            </a>
                        </li>
                        <!-- <li class="list-group-item">
                            <a class="text-primary link-underline link-underline-opacity-0" href="tel:+6287847680155">
                                Telp: +6287847680155
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
            <hr>
            <span>Copyright 2024 Fishiden</span>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 80) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>