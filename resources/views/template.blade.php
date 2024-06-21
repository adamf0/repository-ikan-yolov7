<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content='Klasifikasi Ikan; Kecerdasan Buatan; AI; Image Processing; Object Detection; Ikan Laut dan Ikan Tawar; Perairan Indonesia;' name='Keywords' />
    <meta content='Situs klasifikasi ikan berbasis kecerdasan buatan ini memudahkan Anda mengenali semua ikan laut dan tawar di perairan Indonesia.' name='deskripsi' />
    <title>Fishiden</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
@yield('css')

<body>
    <header>
        <div class="container text-center row">
            <button class="nav-toggle" aria-label="open navigation">
                <i class="fas fa-bars"></i>
            </button>
            <a class="logo" href="{{ route('home') }}">
                <h1>Fishiden</h1>
            </a>
            <nav class="nav">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#apa_fishiden" class="nav__link">Apa itu Fishiden</a>
                    </li>
                    <li class="nav__item">
                        <a href="#cara_kerja" class="nav__link">Cara Kerja</a>
                    </li>
                    <li class="nav__item">
                        <a href="#keahlian" class="nav__link">Keahlian</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('about') }}" class="nav__link {{\App\Helper\Utility::stateMenu(['about'],request())? 'nav__link--button':''}}">Tentang</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('familyguide') }}" class="nav__link {{\App\Helper\Utility::stateMenu(['family_guide'],request())? 'nav__link--button':''}}">Gallery</a>
                    </li>
                    <li class="nav__item">
                        @if (!Session::has("level"))
                        <a href="{{ route('login.index') }}" class="nav__link">Login</a>
                        @else
                        <a href="{{ route('dashboard.index') }}" class="nav__link">Dashboard</a>
                        @endif
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    @yield('content')
    <footer>
        <div class="footer__container">
            <div class="footer__contact">
                <h3>Contact Us</h3>
                <div class="footer__contact--item">
                    <a href="mailto:rifkimunandar13@gmail.com"><i class="fa-solid fa-envelope"></i></a>
                    <a href="tel:+6287847680155"><i class="fa-solid fa-phone"></i></a>
                </div>
            </div>
            <div class="footer__repository">
                <h3>Quick Link</h3>
                <ul>
                    <li>
                        <a href="https://www.fishbase.se/">FishBase</a>
                    </li>
                    <li>
                        <a href="https://www.iucnredlist.org/">The IUCN Red List of Threatened SpeciesTM</a>
                    </li>
                    <li>
                        <a href="https://www.ncbi.nlm.nih.gov/">NCBI (National Center for Biotechnology Information)</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    function getCountry() {
        const language = navigator.language || navigator.userLanguage;
        if (language.includes('id')) {
            return 'Indonesia';
        } else {
            return 'Other';
        }
    }

    function setMetaTags() {
        const country = getCountry();

        let keywords = '';
        let description = '';

        if (country === 'Indonesia') {
            keywords = 'Klasifikasi Ikan; Kecerdasan Buatan; AI; Image Processing; Object Detection; Ikan Laut dan Ikan Tawar; Perairan Indonesia;';
            description = 'Situs klasifikasi ikan berbasis kecerdasan buatan ini memudahkan Anda mengenali semua ikan laut dan tawar di perairan Indonesia.';
        } else {
            keywords = 'Fish classification; Artificial intelligence; AI; Image Processing; Object Detection; Sea Fish and Freshwater Fish;';
            description = 'This AI-based fish classification site makes it easy for you to recognize all sea and freshwater fish.';
        }

        const keywordsMeta = document.createElement('meta');
        keywordsMeta.name = 'Keywords';
        keywordsMeta.content = keywords;
        document.head.appendChild(keywordsMeta);

        const descriptionMeta = document.createElement('meta');
        descriptionMeta.name = 'description';
        descriptionMeta.content = description;
        document.head.appendChild(descriptionMeta);
    }

    // Panggil fungsi untuk mengatur meta tag setelah halaman dimuat
    document.addEventListener('DOMContentLoaded', setMetaTags);
</script>
<script>
    $(document).ready(function() {
        const navToggle = document.querySelector('.nav-toggle');
        const nav = document.querySelector('.nav');

        navToggle.addEventListener('click', () => {
            nav.classList.toggle('nav--visible');
        });
    });
</script>
@yield('script')

</html>