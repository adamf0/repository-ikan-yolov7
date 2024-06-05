<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <a href="{{ route('familyguide') }}" class="nav__link {{\App\Helper\Utility::stateMenu(['family_guide'],request())? 'nav__link--button':''}}">Family Guide</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('about') }}" class="nav__link {{\App\Helper\Utility::stateMenu(['about'],request())? 'nav__link--button':''}}">About</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('login') }}" class="nav__link">Login</a>
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
                </ul>
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