<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/shah.png') }}" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>Aizat Hamizan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">Aizat Hamizan</a>
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="#home" class="nav__link active-link"><i class="bx bx-home-alt"></i></a></li>
                    <li class="nav__item"><a href="#about" class="nav__link"><i class="bx bx-user"></i></a></li>
                    <li class="nav__item"><a href="#skills" class="nav__link"><i class="bx bx-book"></i></a></li>
                    <li class="nav__item"><a href="#work" class="nav__link"><i class="bx bx-briefcase-alt-2"></i></a></li>
                    <li class="nav__item"><a href="#contact" class="nav__link"><i class="bx bx-message-square-detail"></i></a></li>
                </ul>
            </div>
            <i class='bx bx-moon change-theme' id='theme-button'></i>
        </nav>
    </header>
    <main class="main">
        @yield('content')
    </main>
    <footer class="footer">
        <div class="footer__container container">
            <h1 class="footer__title">Aizat Hamizan</h1>
            <ul class="footer__list">
                <li><a href="#about" class="footer__link">About</a></li>
                <li><a href="#work" class="footer__link">Projects</a></li>
                <li><a href="#testimonial" class="footer__link">Testimonial</a></li>
            </ul>
            <ul class="footer__social">
                <a href="https://www.facebook.com/Shah Raziq/" target="_blank" class="footer__social-link"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/sharazeeq/" target="_blank" class="footer__social-link"><i class="bx bxl-instagram"></i></a>
                <a href="https://twitter.com/" target="_blank" class="footer__social-link"><i class="bx bxl-twitter"></i></a>
            </ul>
            <span class="footer__copy">&#169; AizatHamizan. All rights reserved</span>
        </div>
    </footer>
    <script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
