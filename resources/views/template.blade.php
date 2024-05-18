<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('style.css') }}">
</head>
@yield('css')
<body>
    <header>
        <div class="container text-center row">
            <button class="nav-toggle" aria-label="open navigation">
                <i class="fas fa-bars"></i>
            </button>
            <a class="logo" href="{{ route('home') }}">
                <img src="{{ \App\Helper\Utility::loadAsset('img/logo.svg') }}" alt="logo aplikasi">
            </a>
            <nav class="nav">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('familyguide') }}" class="nav__link {{\App\Helper\Utility::stateMenu(['family_guide'],request())? 'nav__link--button':''}}">Family Guide</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('about') }}" class="nav__link {{\App\Helper\Utility::stateMenu(['about'],request())? 'nav__link--button':''}}">About</a>
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
                <table>
                    <tr>
                        <td>Email</td>
                        <td><a href="mailto:rifkimunandar13@gmail.com">rifkimunandar13@gmail.com</a></td>
                    </tr>
                    <tr>
                        <td>Telp</td>
                        <td><a href="tel:+6287847680155">087847680155</a></td>
                    </tr>
                </table>
            </div>
            <div class="footer__repository">
                <h3>Quick Link</h3>
                <ul>
                    <li>
                        <a href="https://www.fishbase.se">FishBase</a>
                    </li>
                    <li>
                        <a href="https://www.iucnredlist.org/">The IUCN Red List of Threatened SpeciesTM</a>
                    </li>
                </ul>
            </div>
            <div class="footer__copyright">
                <p>copyright &copy; 2024</p>
            </div>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $(document).ready(function(){
        const navToggle = document.querySelector('.nav-toggle');
        const nav = document.querySelector('.nav');

        navToggle.addEventListener('click', () => {
            nav.classList.toggle('nav--visible');
        });
    });
</script>
@yield('script')
</html>