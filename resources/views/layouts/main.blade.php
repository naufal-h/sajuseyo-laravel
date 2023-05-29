@php
    $totalQuantity = 0;
    if (auth()->check()) {
        $user = auth()->user();
        $totalQuantity = $user->carts->sum('quantity');
    }
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>sajuseyo!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet" />
    @yield('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/button.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
</head>

<body>
    <header>
        <nav class="navbar">
            <div data-collapse="small" class="nav-bar navibar">
                <div class="wrapper nav-container page-container">
                    <div class="logo-div">
                        <a href="{{ route('home') }}" class="nav-logo w-inline-block w--current"><img
                                src="/assets/logo/logo.png" height="30" class="logo" /></a>
                    </div>
                    <nav role="navigation" class="nav-content navibar-menu">
                        <div class="search-banner">
                            <div class="search-section">
                                <form action="/search.html" class="search nav-form">
                                    <input type="search" class="search-bar nav-input" maxlength="256"
                                        placeholder="Search here..." id="search" required="" /><input
                                        type="submit" value="Search" class="hidden w-button" />
                                </form>
                            </div>
                        </div>
                        <div class="nav-menu">
                            <button class="btn-pjg">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.8206 6.10134C21.7575 6.01178 21.6739 5.93868 21.5767 5.8882C21.4795 5.83772 21.3716 5.81133 21.262 5.81126H6.67123L5.56676 2.00251C5.13364 0.502727 4.10443 0.34082 3.6823 0.34082H0.737396C0.359938 0.34082 0.0546875 0.646414 0.0546875 1.02351C0.0546875 1.4006 0.360281 1.70617 0.737375 1.70617H3.68194C3.77509 1.70617 4.05938 1.70617 4.25327 2.37614L8.05274 16.3396C8.13524 16.6342 8.40371 16.8377 8.70997 16.8377H17.9905C18.2786 16.8377 18.5357 16.6572 18.633 16.386L21.9041 6.7249C21.9794 6.51556 21.9481 6.2825 21.8206 6.10134H21.8206ZM17.5101 15.4727H9.22815L7.05496 7.17698H20.2914L17.5101 15.4727ZM16.1561 18.2213C15.2066 18.2213 14.4373 18.9906 14.4373 19.9401C14.4373 20.8895 15.2066 21.6588 16.1561 21.6588C17.1055 21.6588 17.8748 20.8895 17.8748 19.9401C17.8748 18.9906 17.1055 18.2213 16.1561 18.2213ZM9.96859 18.2213C9.01915 18.2213 8.24984 18.9906 8.24984 19.9401C8.24984 20.8895 9.01915 21.6588 9.96859 21.6588C10.918 21.6588 11.6873 20.8895 11.6873 19.9401C11.6873 18.9906 10.918 18.2213 9.96859 18.2213Z" />
                                </svg>
                                <a href="{{ route('cart.show') }}" style="margin-left: 7px">Cart</a>
                                <div class="item-count">{{ $totalQuantity }}</div>
                            </button>
                            <a href="wishlist.html" class="btn2">
                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.00252 1.52123C6.98058 -0.0524605 4.05114 0.0891645 2.19283 1.94679C0.180516 3.9591 0.180516 7.22679 2.19283 9.2391L8.51233 15.5586C8.78114 15.8274 9.21633 15.8274 9.48514 15.5586L15.8046 9.2391C17.817 7.22679 17.817 3.9591 15.8046 1.94679C13.9553 0.0974144 11.0258 -0.0332104 9.00252 1.52123ZM8.99977 3.12173C9.30089 3.11623 9.45833 2.94435 9.48308 2.92304C11.1021 1.51366 13.3613 1.44835 14.8325 2.9196C16.3079 4.39498 16.3079 6.79092 14.8325 8.26698L8.99839 14.1004L3.16495 8.26698C1.68958 6.79092 1.68958 4.39498 3.16495 2.9196C4.64102 1.44354 7.03764 1.44423 8.5137 2.92029C8.64227 3.04885 8.81758 3.12173 8.99977 3.12173Z" />
                                </svg>
                            </a>
                            <a href="{{ auth()->check() ? '' : route('login') }}" class="btn2">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22 10.989C22 4.9225 17.072 0 11 0C4.928 0 0 4.9225 0 10.989C0 14.3302 1.518 17.3415 3.894 19.3627C3.916 19.3848 3.938 19.3848 3.938 19.4067C4.136 19.5608 4.334 19.7148 4.554 19.8687C4.664 19.9347 4.752 20.0214 4.862 20.1094C6.67984 21.3419 8.82573 22.0005 11.022 22C13.2183 22.0005 15.3642 21.3419 17.182 20.1094C17.292 20.0434 17.38 19.9568 17.49 19.8894C17.688 19.7367 17.908 19.5828 18.106 19.4288C18.128 19.4067 18.15 19.4067 18.15 19.3848C20.482 17.3401 22 14.3302 22 10.989ZM11 20.6154C8.932 20.6154 7.04 19.9554 5.478 18.8568C5.5 18.6807 5.544 18.5061 5.588 18.3301C5.71909 17.8531 5.91135 17.3951 6.16 16.9675C6.402 16.5495 6.688 16.1755 7.04 15.8455C7.37 15.5155 7.766 15.2089 8.162 14.9669C8.58 14.7249 9.02 14.5489 9.504 14.4169C9.99177 14.2854 10.4948 14.2193 11 14.2203C12.4996 14.2096 13.9442 14.7849 15.026 15.8235C15.532 16.3295 15.928 16.9235 16.214 17.6041C16.368 18.0001 16.478 18.4181 16.544 18.8568C14.9204 19.9982 12.9847 20.6122 11 20.6154ZM7.634 10.4404C7.44016 9.99655 7.34268 9.51665 7.348 9.03237C7.348 8.54975 7.436 8.06575 7.634 7.62575C7.832 7.18575 8.096 6.79112 8.426 6.46112C8.756 6.13112 9.152 5.8685 9.592 5.6705C10.032 5.4725 10.516 5.3845 11 5.3845C11.506 5.3845 11.968 5.4725 12.408 5.6705C12.848 5.8685 13.244 6.1325 13.574 6.46112C13.904 6.79112 14.168 7.18713 14.366 7.62575C14.564 8.06575 14.652 8.54975 14.652 9.03237C14.652 9.53837 14.564 10.0004 14.366 10.439C14.1749 10.8725 13.9065 11.2676 13.574 11.605C13.2365 11.937 12.8414 12.205 12.408 12.3956C11.4989 12.7692 10.4791 12.7692 9.57 12.3956C9.13662 12.205 8.74152 11.937 8.404 11.605C8.071 11.2725 7.80903 10.8772 7.634 10.4404ZM17.842 17.7361C17.842 17.6921 17.82 17.6701 17.82 17.6261C17.6036 16.9378 17.2847 16.2861 16.874 15.6929C16.4629 15.0953 15.9577 14.5682 15.378 14.1322C14.9353 13.7992 14.4554 13.5187 13.948 13.2963C14.1788 13.144 14.3927 12.9674 14.586 12.7696C14.914 12.4458 15.202 12.0839 15.444 11.6916C15.9312 10.8911 16.1829 9.96942 16.17 9.03237C16.1768 8.33871 16.0421 7.65094 15.774 7.01113C15.5093 6.39463 15.1284 5.83489 14.652 5.3625C14.1763 4.89504 13.6165 4.52181 13.002 4.2625C12.3611 3.99492 11.6725 3.86065 10.978 3.86787C10.2834 3.86108 9.59478 3.99582 8.954 4.26388C8.33422 4.52263 7.77303 4.90378 7.304 5.3845C6.83656 5.85968 6.46332 6.41908 6.204 7.03312C5.93594 7.67294 5.8012 8.36071 5.808 9.05437C5.808 9.53837 5.874 10.0004 6.006 10.439C6.138 10.901 6.314 11.319 6.556 11.7136C6.776 12.1096 7.084 12.4616 7.414 12.7916C7.612 12.9896 7.832 13.1642 8.074 13.3182C7.56502 13.5466 7.08499 13.8346 6.644 14.1763C6.072 14.6163 5.566 15.1429 5.148 15.7149C4.73311 16.3056 4.41386 16.958 4.202 17.6481C4.18 17.6921 4.18 17.7361 4.18 17.7581C2.442 15.9995 1.364 13.6263 1.364 10.989C1.364 5.6925 5.698 1.36263 11 1.36263C16.302 1.36263 20.636 5.6925 20.636 10.989C20.6331 13.5189 19.6286 15.9448 17.842 17.7361Z" />
                                </svg>
                            </a>
                        </div>
                    </nav>
                    <div class="menu-button navibar-button">
                        <img src="/assets/svg/hamburger.svg" width="30" class="menu-icon" />
                    </div>
                </div>
            </div>
            <div class="navbar__bottom">
                <div class="wrapper navbar__wrapper">
                    <div class="navbar__start">
                        <nav class="nav">
                            <ul class="nav__wrapper" style="list-style: none">
                                <li class="nav__item"><a href="{{ route('home') }}">Home</a></li>
                                <div class="usnm-drop">
                                    <li class="nav__item"><a>Product</a></li>
                                    <div class="usnm-opt">
                                        <a href="{{ route('products.category', ['categoryId' => 1]) }}">Music</a>
                                        <a href="{{ route('products.category', ['categoryId' => 2]) }}">Fanlight</a>
                                        <a href="{{ route('products.category', ['categoryId' => 3]) }}">Photo Book</a>
                                        <a href="{{ route('products.category', ['categoryId' => 4]) }}">Printed
                                            Photo</a>
                                    </div>
                                </div>
                                <div class="usnm-drop">
                                    <li class="nav__item"><a>Celeb</a></li>
                                    <div class="usnm-opt">
                                        <a href="{{ route('products.agency', ['agencyId' => 1]) }}">SM Ent.</a>
                                        <a href="{{ route('products.agency', ['agencyId' => 2]) }}">JYP Ent.</a>
                                        <a href="{{ route('products.agency', ['agencyId' => 3]) }}">YG Ent.</a>
                                        <a href="{{ route('products.agency', ['agencyId' => 4]) }}">HYBE Corp.</a>
                                        <a href="{{ route('products.agency', ['agencyId' => 5]) }}">Cube Ent.</a>
                                        <a href="{{ route('products.agency', ['agencyId' => 6]) }}">Others</a>
                                    </div>
                                </div>
                                <li class="nav__item"><a href="">Deals</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="welcome">
                        <p>Welcome,&nbsp;
                        <div class="usnm-drop">
                            @auth
                                <a class="usernm">{{ Auth::user()->name }}!</a>
                            @else
                                <a class="usernm">Guest!</a>
                            @endauth
                            <div class="usnm-opt">
                                @auth
                                    <a href="#">Profile</a>
                                    <a
                                        href="{{ route('logout') }}"onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @else
                                    <a href="{{ route('login') }}">Login</a>
                                    <a href="{{ route('register') }}">Register</a>
                                @endauth

                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-logo-block">
                    <a href="{{ route('home') }}" class="footer-logo">
                        <img src="/assets/logo/logo-black.png" width="304" />
                    </a>
                    <p class="tag-line">
                        원스톱 케이팝 매장
                        <br />Your one-stop K-pop shop.
                    </p>
                </div>
                <div class="footer-links-container">
                    <h5 class="footer-header">Product</h5>
                    <a href="{{ route('products.category', ['categoryId' => 1]) }}" class="footer-link">Music</a>
                    <a href="{{ route('products.category', ['categoryId' => 2]) }}" class="footer-link">Fanlight</a>
                    <a href="{{ route('products.category', ['categoryId' => 3]) }}" class="footer-link">Photo
                        Book</a>
                    <a href="{{ route('products.category', ['categoryId' => 4]) }}" class="footer-link">Printed
                        Photo</a>
                </div>
                <div class="footer-links-container">
                    <h5 class="footer-header">Celeb</h5>
                    <a href="{{ route('products.agency', ['agencyId' => 1]) }}" class="footer-link">SM Ent.</a>
                    <a href="{{ route('products.agency', ['agencyId' => 2]) }}" class="footer-link">JYP Ent.</a>
                    <a href="{{ route('products.agency', ['agencyId' => 3]) }}" class="footer-link">YG Ent.</a>
                    <a href="{{ route('products.agency', ['agencyId' => 4]) }}" class="footer-link">HYBE Corp.</a>
                    <a href="{{ route('products.agency', ['agencyId' => 5]) }}" class="footer-link">Cube Ent.</a>
                    <a href="{{ route('products.agency', ['agencyId' => 6]) }}" class="footer-link">Others</a>
                </div>
                <div class="footer-links-container">
                    <h5 class="footer-header">Help</h5>
                    <a href="aboutus.html" class="footer-link">About Us</a>
                    <a href="tnc.html" class="footer-link">Terms &amp; Conditions</a>
                    <a href="policy.html" class="footer-link">Privacy Policy</a>
                </div>
            </div>
        </div>
        <div class="footer-border"></div>
        <div class="footer-bottom">
            <div class="footer-copyright">&copy; Copyright 2023 - Sajuseyo!</div>
            <div class="footer-social">
                <a href="www.facebook.com" class="footer-social-icon">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="www.instagram.com" class="footer-social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="www.twitter.com" class="footer-social-icon">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>
