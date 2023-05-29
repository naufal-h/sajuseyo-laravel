<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Admin Dashboard" />
    <title>Admin Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet" />
    @yield('styles')
</head>

<body class="header-fixed sidebar-fixed sidebar-light header-light" id="body">
    <div class="wrapper">
        <div class="left-sidebar">
            <div id="sidebar" class="sidebar sidebar-footer">
                <div class="brand">
                    <a href="{{ route('admin.dashboard') }}">
                        <img class="brand-icon" src="{{ asset('assets/logo/logo-small.png') }}" alt="" />
                        <span class="brand-name text-truncate">Sajuseyo!</span>
                    </a>
                </div>

                <div class="navigation" data-simplebar="init">
                    <div class="simplebar-wrapper" style="margin: 0px">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px">
                                <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden">
                                    <div class="simplebar-content" style="padding: 0px">
                                        <ul class="nav sidebar-inner" id="sidebar-menu">
                                            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                                                <a class="sidenav-item-link" href="{{ route('admin.dashboard') }}">
                                                    <svg class="nav-icon" width="24" height="24"
                                                        viewBox="0 0 800 800" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_759_232)">
                                                            <path
                                                                d="M600 133.333H200C163.181 133.333 133.333 163.181 133.333 200V600C133.333 636.819 163.181 666.666 200 666.666H600C636.819 666.666 666.666 636.819 666.666 600V200C666.666 163.181 636.819 133.333 600 133.333Z"
                                                                stroke="{{ Request::is('admin/dashboard') ? '#EAB8C0' : '#1C2331' }}"
                                                                stroke-width="66.6667" stroke-linecap="round" />
                                                            <path d="M133.333 300H666.666"
                                                                stroke="{{ Request::is('admin/dashboard') ? '#EAB8C0' : '#1C2331' }}"
                                                                stroke-width="66.6667" stroke-linecap="round" />
                                                            <path d="M300 333.333V666.666"
                                                                stroke="{{ Request::is('admin/dashboard') ? '#EAB8C0' : '#1C2331' }}"
                                                                stroke-width="66.6667" stroke-linecap="round" />
                                                        </g>
                                                    </svg>
                                                    <span class="nav-text">Dashboard</span>
                                                </a>
                                                <hr />
                                            </li>

                                            <li class="has-sub">
                                                <a class="sidenav-item-link" href="javascript:void(0)">
                                                    <svg class="nav-icon" width="24" height="24"
                                                        viewBox="0 0 800 800" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M700.01 222.46C700.01 290.08 645.17 344.92 577.55 344.92C509.93 344.92 455.12 290.08 455.12 222.46C455.12 154.84 509.93 100 577.55 100C645.17 100 700.01 154.84 700.01 222.46Z"
                                                            stroke="#1c2331" stroke-width="50" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M344.89 222.46C344.89 290.08 290.08 344.92 222.43 344.92C154.84 344.92 100 290.08 100 222.46C100 154.84 154.84 100 222.43 100C290.08 100 344.89 154.84 344.89 222.46Z"
                                                            stroke="#1c2331" stroke-width="50" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M700.01 575.397C700.01 643.016 645.17 697.826 577.55 697.826C509.93 697.826 455.12 643.016 455.12 575.397C455.12 507.777 509.93 452.937 577.55 452.937C645.17 452.937 700.01 507.777 700.01 575.397Z"
                                                            stroke="#1c2331" stroke-width="50" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M344.89 575.397C344.89 643.016 290.08 697.826 222.43 697.826C154.84 697.826 100 643.016 100 575.397C100 507.777 154.84 452.937 222.43 452.937C290.08 452.937 344.89 507.777 344.89 575.397Z"
                                                            stroke="#1c2331" stroke-width="50" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="nav-text">Categories</span>
                                                    <div class="caret"></div>
                                                </a>

                                                <div class="collapse">
                                                    <ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
                                                        <li class="">
                                                            <a class="sidenav-item-link" href="./main-category.html">
                                                                <span class="nav-text">Main Category</span>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a class="sidenav-item-link" href="./sub-category.html">
                                                                <span class="nav-text">Sub Category</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                            <li
                                                class="has-sub {{ Request::is('admin/products*') ? 'active expand' : '' }}">
                                                <a class="sidenav-item-link" href="javascript:void(0)">
                                                    <svg class="nav-icon" width="24" height="24"
                                                        viewBox="0 0 800 800" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_759_238)">
                                                            <path
                                                                d="M475 43.3013L671.41 156.699C717.82 183.494 746.41 233.013 746.41 286.603V513.397C746.41 566.987 717.82 616.506 671.41 643.301L475 756.699C428.59 783.494 371.41 783.494 325 756.699L128.59 643.301C82.1797 616.506 53.5898 566.987 53.5898 513.397V286.603C53.5898 233.013 82.1797 183.494 128.59 156.699L325 43.3013C371.41 16.5063 428.59 16.5063 475 43.3013ZM355.221 83.7907L350 86.6025L153.59 200C124.278 216.923 105.629 247.443 103.747 280.986L103.59 286.603V513.397C103.59 547.244 120.696 578.654 148.804 597.055L153.59 600L350 713.397C379.221 730.268 414.847 731.206 444.779 716.209L450 713.397L646.41 600C675.722 583.077 694.371 552.557 696.253 519.014L696.41 513.397V286.603C696.41 252.756 679.304 221.346 651.196 202.945L646.41 200L450 86.6025C420.779 69.7317 385.153 68.7944 355.221 83.7907ZM575.508 288.934C581.99 301.125 577.362 316.263 565.171 322.745L424.712 397.416L424.713 566.639C424.713 580.446 413.52 591.639 399.713 591.639C385.906 591.639 374.713 580.446 374.713 566.639L374.712 397.416L234.255 322.745C222.064 316.263 217.436 301.125 223.918 288.934C230.4 276.743 245.538 272.115 257.729 278.598L399.712 354.066L541.697 278.598C553.888 272.115 569.026 276.743 575.508 288.934Z"
                                                                fill="{{ Request::is('admin/products*') ? '#EAB8C0' : '#1C2331' }}" />
                                                        </g>
                                                    </svg>

                                                    <span class="nav-text">Products</span>
                                                    <div class="caret"></div>
                                                </a>
                                                <div
                                                    class="collapse {{ Request::is('admin/products*') ? 'show' : '' }}">
                                                    <ul class="sub-menu" id="products" data-parent="#sidebar-menu">
                                                        <li class="">
                                                            <a class="sidenav-item-link"
                                                                href="{{ route('admin.products.create') }}">
                                                                <span class="nav-text">Add
                                                                    Product</span>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a class="sidenav-item-link"
                                                                href="{{ url('/admin/products') }}">
                                                                <span class="nav-text">List Product</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                            <li>
                                                <a class="sidenav-item-link" href="././list-order.html">
                                                    <svg class="nav-icon" width="24" height="24"
                                                        viewBox="0 0 800 800" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M149.4 220.28C154.069 192.254 168.531 166.793 190.213 148.43C211.894 130.067 239.387 119.993 267.8 120H532.2C560.613 119.993 588.106 130.067 609.787 148.43C631.469 166.793 645.931 192.254 650.6 220.28L680 400V600C680 621.217 671.571 641.566 656.569 656.569C641.566 671.571 621.217 680 600 680H200C178.783 680 158.434 671.571 143.431 656.569C128.429 641.566 120 621.217 120 600V400L149.4 220.28ZM267.8 200C258.325 199.995 249.156 203.353 241.925 209.477C234.695 215.601 229.874 224.093 228.32 233.44L200 400V440H255.76C279.464 439.995 302.638 447.01 322.36 460.16L355.64 482.36C368.778 491.114 384.213 495.785 400 495.785C415.787 495.785 431.222 491.114 444.36 482.36L477.64 460.16C497.373 447.002 520.563 439.987 544.28 440H600V400L571.68 233.44C570.127 224.1 565.312 215.614 558.09 209.49C550.868 203.367 541.708 200.004 532.24 200H267.76H267.8Z"
                                                            fill="#1C2331" />
                                                    </svg>

                                                    <span class="nav-text">Orders</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidenav-item-link" href="././list-order.html">
                                                    <svg class="nav-icon" width="24" height="24"
                                                        viewBox="0 0 22 22" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M22 10.989C22 4.9225 17.072 0 11 0C4.928 0 0 4.9225 0 10.989C0 14.3302 1.518 17.3415 3.894 19.3627C3.916 19.3848 3.938 19.3848 3.938 19.4067C4.136 19.5608 4.334 19.7148 4.554 19.8687C4.664 19.9347 4.752 20.0214 4.862 20.1094C6.67984 21.3419 8.82573 22.0005 11.022 22C13.2183 22.0005 15.3642 21.3419 17.182 20.1094C17.292 20.0434 17.38 19.9568 17.49 19.8894C17.688 19.7367 17.908 19.5828 18.106 19.4288C18.128 19.4067 18.15 19.4067 18.15 19.3848C20.482 17.3401 22 14.3302 22 10.989ZM11 20.6154C8.932 20.6154 7.04 19.9554 5.478 18.8568C5.5 18.6807 5.544 18.5061 5.588 18.3301C5.71909 17.8531 5.91135 17.3951 6.16 16.9675C6.402 16.5495 6.688 16.1755 7.04 15.8455C7.37 15.5155 7.766 15.2089 8.162 14.9669C8.58 14.7249 9.02 14.5489 9.504 14.4169C9.99177 14.2854 10.4948 14.2193 11 14.2203C12.4996 14.2096 13.9442 14.7849 15.026 15.8235C15.532 16.3295 15.928 16.9235 16.214 17.6041C16.368 18.0001 16.478 18.4181 16.544 18.8568C14.9204 19.9982 12.9847 20.6122 11 20.6154ZM7.634 10.4404C7.44016 9.99655 7.34268 9.51665 7.348 9.03237C7.348 8.54975 7.436 8.06575 7.634 7.62575C7.832 7.18575 8.096 6.79112 8.426 6.46112C8.756 6.13112 9.152 5.8685 9.592 5.6705C10.032 5.4725 10.516 5.3845 11 5.3845C11.506 5.3845 11.968 5.4725 12.408 5.6705C12.848 5.8685 13.244 6.1325 13.574 6.46112C13.904 6.79112 14.168 7.18713 14.366 7.62575C14.564 8.06575 14.652 8.54975 14.652 9.03237C14.652 9.53837 14.564 10.0004 14.366 10.439C14.1749 10.8725 13.9065 11.2676 13.574 11.605C13.2365 11.937 12.8414 12.205 12.408 12.3956C11.4989 12.7692 10.4791 12.7692 9.57 12.3956C9.13662 12.205 8.74152 11.937 8.404 11.605C8.071 11.2725 7.80903 10.8772 7.634 10.4404ZM17.842 17.7361C17.842 17.6921 17.82 17.6701 17.82 17.6261C17.6036 16.9378 17.2847 16.2861 16.874 15.6929C16.4629 15.0953 15.9577 14.5682 15.378 14.1322C14.9353 13.7992 14.4554 13.5187 13.948 13.2963C14.1788 13.144 14.3927 12.9674 14.586 12.7696C14.914 12.4458 15.202 12.0839 15.444 11.6916C15.9312 10.8911 16.1829 9.96942 16.17 9.03237C16.1768 8.33871 16.0421 7.65094 15.774 7.01113C15.5093 6.39463 15.1284 5.83489 14.652 5.3625C14.1763 4.89504 13.6165 4.52181 13.002 4.2625C12.3611 3.99492 11.6725 3.86065 10.978 3.86787C10.2834 3.86108 9.59478 3.99582 8.954 4.26388C8.33422 4.52263 7.77303 4.90378 7.304 5.3845C6.83656 5.85968 6.46332 6.41908 6.204 7.03312C5.93594 7.67294 5.8012 8.36071 5.808 9.05437C5.808 9.53837 5.874 10.0004 6.006 10.439C6.138 10.901 6.314 11.319 6.556 11.7136C6.776 12.1096 7.084 12.4616 7.414 12.7916C7.612 12.9896 7.832 13.1642 8.074 13.3182C7.56502 13.5466 7.08499 13.8346 6.644 14.1763C6.072 14.6163 5.566 15.1429 5.148 15.7149C4.73311 16.3056 4.41386 16.958 4.202 17.6481C4.18 17.6921 4.18 17.7361 4.18 17.7581C2.442 15.9995 1.364 13.6263 1.364 10.989C1.364 5.6925 5.698 1.36263 11 1.36263C16.302 1.36263 20.636 5.6925 20.636 10.989C20.6331 13.5189 19.6286 15.9448 17.842 17.7361Z"
                                                            fill="#1C2331" />
                                                    </svg>

                                                    <span class="nav-text">Users</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sidenav-item-link" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    <svg class="nav-icon" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.9999 2C10.2385 2 7.99991 4.23858 7.99991 7C7.99991 7.55228 8.44762 8 8.99991 8C9.55219 8 9.99991 7.55228 9.99991 7C9.99991 5.34315 11.3431 4 12.9999 4H16.9999C18.6568 4 19.9999 5.34315 19.9999 7V17C19.9999 18.6569 18.6568 20 16.9999 20H12.9999C11.3431 20 9.99991 18.6569 9.99991 17C9.99991 16.4477 9.55219 16 8.99991 16C8.44762 16 7.99991 16.4477 7.99991 17C7.99991 19.7614 10.2385 22 12.9999 22H16.9999C19.7613 22 21.9999 19.7614 21.9999 17V7C21.9999 4.23858 19.7613 2 16.9999 2H12.9999Z"
                                                            fill="#1c2331" />
                                                        <path
                                                            d="M13.9999 11C14.5522 11 14.9999 11.4477 14.9999 12C14.9999 12.5523 14.5522 13 13.9999 13V11Z"
                                                            fill="#1c2331" />
                                                        <path
                                                            d="M5.71783 11C5.80685 10.8902 5.89214 10.7837 5.97282 10.682C6.21831 10.3723 6.42615 10.1004 6.57291 9.90549C6.64636 9.80795 6.70468 9.72946 6.74495 9.67492L6.79152 9.61162L6.804 9.59454L6.80842 9.58848C6.80846 9.58842 6.80892 9.58778 5.99991 9L6.80842 9.58848C7.13304 9.14167 7.0345 8.51561 6.58769 8.19098C6.14091 7.86637 5.51558 7.9654 5.19094 8.41215L5.18812 8.41602L5.17788 8.43002L5.13612 8.48679C5.09918 8.53682 5.04456 8.61033 4.97516 8.7025C4.83623 8.88702 4.63874 9.14542 4.40567 9.43937C3.93443 10.0337 3.33759 10.7481 2.7928 11.2929L2.08569 12L2.7928 12.7071C3.33759 13.2519 3.93443 13.9663 4.40567 14.5606C4.63874 14.8546 4.83623 15.113 4.97516 15.2975C5.04456 15.3897 5.09918 15.4632 5.13612 15.5132L5.17788 15.57L5.18812 15.584L5.19045 15.5872C5.51509 16.0339 6.14091 16.1336 6.58769 15.809C7.0345 15.4844 7.13355 14.859 6.80892 14.4122L5.99991 15C6.80892 14.4122 6.80897 14.4123 6.80892 14.4122L6.804 14.4055L6.79152 14.3884L6.74495 14.3251C6.70468 14.2705 6.64636 14.1921 6.57291 14.0945C6.42615 13.8996 6.21831 13.6277 5.97282 13.318C5.89214 13.2163 5.80685 13.1098 5.71783 13H13.9999V11H5.71783Z"
                                                            fill="#1c2331" />
                                                    </svg>

                                                    <span class="nav-text">Logout</span>
                                                    <form id="logout-form" action="{{ route('logout') }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: auto; height: 632px"></div>
                    </div>
                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none"></div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden">
                        <div class="simplebar-scrollbar" style="height: 0px; display: none"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <header class="main-header" id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg">
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <svg width="30" height="30" viewBox="0 0 800 800" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M166.667 566.667H633.333M166.667 400H633.333M166.667 233.333H633.333"
                                stroke="#1C2331" stroke-width="66.6667" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div class="search-form">
                        <div class="input-group">
                            <input type="text" name="query" id="search-input" class="form-control"
                                placeholder="search.." autofocus="" autocomplete="off" />
                            <button type="button" name="search" id="search-btn" class="btn btn-flat">
                                <svg width="20" height="20" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.16675 0.916992C4.6104 0.916992 0.916748 4.61065 0.916748 9.16699C0.916748 13.7234 4.6104 17.417 9.16675 17.417C11.1147 17.417 12.9049 16.7419 14.3163 15.6129L18.6019 19.8985C18.9599 20.2565 19.5403 20.2565 19.8983 19.8985C20.2562 19.5405 20.2562 18.9601 19.8983 18.6022L15.6127 14.3166C16.7416 12.9052 17.4167 11.1149 17.4167 9.16699C17.4167 4.61065 13.7231 0.916992 9.16675 0.916992ZM2.75008 9.16699C2.75008 5.62317 5.62292 2.75033 9.16675 2.75033C12.7106 2.75033 15.5834 5.62317 15.5834 9.16699C15.5834 12.7108 12.7106 15.5837 9.16675 15.5837C5.62292 15.5837 2.75008 12.7108 2.75008 9.16699Z"
                                        fill="#1C2331" />
                                </svg>
                            </button>
                        </div>
                        <div id="search-results-container">
                            <ul id="search-results"></ul>
                        </div>
                    </div>

                    <div class="navbar-right">
                        <ul class="nav navbar-nav" style="padding-right: 30px">
                            Welcome, &nbsp;
                            <a style="color: #eab8c0"> Mimin!</a>
                        </ul>
                    </div>
                </nav>
            </header>

            @yield('content')

            <footer class="footer">
                <div class="copyright bg-white">
                    <p>
                        Copyright © <span id="year">2023</span><a class="text-primary" target="_blank">&nbsp;
                            Sajuseyo!</a>&nbsp;All Rights Reserved.
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('script/admin/admin.js') }}"></script>
</body>
