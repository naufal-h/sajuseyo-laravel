@extends('layouts.main')

@section('title', 'Order Details | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detorder.css') }}">
@endsection

@section('content')
    <div class="wrapper user-wrap">
        <div class="user-container">
            @include('layouts.userprofile')
            <div class="width1140">
                @include('layouts.userside')
                <div class="detail-order-main">
                    <div class="detail-order-main-wrap">
                        <div class="detail-order-main-item">
                            <div class="detail-order-main-content">
                                <div class="detail-order-head">
                                    <div>
                                        <span>ORDER ID : {{ $order->id }}
                                        </span><span class="divider">|</span>
                                        @if ($order->order_status_id == 1)
                                            Confirmation received for your order
                                        @elseif ($order->order_status_id == 2)
                                            Waiting for payment confirmation
                                        @elseif ($order->order_status_id == 3)
                                            Your order is being prepared
                                        @elseif ($order->order_status_id == 4)
                                            Your order is on the way
                                        @elseif ($order->order_status_id == 5)
                                            Order successfully completed
                                        @elseif ($order->order_status_id == 6)
                                            Your order has been canceled
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="order-detail-info">
                                        <div class="order-detail-info-pred">
                                            Your order should arrive by
                                            <div class="order-detail-info-date" tabindex="0">
                                                <div><u>
                                                        {{ $order->created_at->addDays(14)->format('d M Y') }}
                                                    </u></div>
                                            </div>
                                            .
                                        </div>

                                        @if ($order->order_status_id == 4)
                                            <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                                                @csrf
                                                <button class="order-received">
                                                    <a style="color: white">Complete Order</a>
                                                </button>
                                            </form>
                                        @else
                                            <button class="order-received" disabled>
                                                <a style="color: white">Complete Order</a>
                                            </button>
                                        @endif


                                    </div>
                                </div>
                                <div class="border-gap"></div>
                                <div class="detail-order-status">
                                    <div class="status-flow-wrap">
                                        <div class="status-flow">
                                            <div class="status-flow-icon status-flow-icon-finish">
                                                <svg width="30" height="30" viewBox="0 0 45 45" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.7002 10.7998H25.2002" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M30.5996 10.7998H33.2996" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M11.7002 16.2002H21.6002" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M30.5996 16.2002H33.2996" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M11.7002 21.6001H25.2002" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M30.5996 21.6001H33.2996" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M11.7002 27H21.6002" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M30.5996 27H33.2996" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M27.9004 36.8999H33.3004" stroke="#EAB8C0" stroke-width="3"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M42.3002 41.4001C42.3002 40.4056 41.4947 39.6001 40.5002 39.6001H38.7002V42.3001H6.3002V39.6001H4.5002C3.5057 39.6001 2.7002 40.4056 2.7002 41.4001C2.7002 42.3946 3.5057 43.2001 4.5002 43.2001H40.5002C41.4947 43.2001 42.3002 42.3946 42.3002 41.4001Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M6.2998 2.7002L8.0998 3.6002L9.8998 2.7002L11.6998 3.6002L13.4998 2.7002L15.2998 3.6002L17.0998 2.7002L18.8998 3.6002L20.6998 2.7002L22.4998 3.6002L24.2998 2.7002L26.0998 3.6002L27.8998 2.7002L29.6998 3.6002L31.4998 2.7002L33.2998 3.6002L35.0998 2.7002L36.8998 3.6002L38.6998 2.7002V42.3002H6.2998V2.7002Z"
                                                        stroke="#EAB8C0" stroke-width="3" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M11.6998 33.3C12.1969 33.3 12.5998 32.8971 12.5998 32.4C12.5998 31.9029 12.1969 31.5 11.6998 31.5C11.2027 31.5 10.7998 31.9029 10.7998 32.4C10.7998 32.8971 11.2027 33.3 11.6998 33.3Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M14.4 33.3C14.8971 33.3 15.3 32.8971 15.3 32.4C15.3 31.9029 14.8971 31.5 14.4 31.5C13.9029 31.5 13.5 31.9029 13.5 32.4C13.5 32.8971 13.9029 33.3 14.4 33.3Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M17.1002 33.3C17.5973 33.3 18.0002 32.8971 18.0002 32.4C18.0002 31.9029 17.5973 31.5 17.1002 31.5C16.6031 31.5 16.2002 31.9029 16.2002 32.4C16.2002 32.8971 16.6031 33.3 17.1002 33.3Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M19.8004 33.3C20.2974 33.3 20.7004 32.8971 20.7004 32.4C20.7004 31.9029 20.2974 31.5 19.8004 31.5C19.3033 31.5 18.9004 31.9029 18.9004 32.4C18.9004 32.8971 19.3033 33.3 19.8004 33.3Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M22.4996 33.3C22.9967 33.3 23.3996 32.8971 23.3996 32.4C23.3996 31.9029 22.9967 31.5 22.4996 31.5C22.0026 31.5 21.5996 31.9029 21.5996 32.4C21.5996 32.8971 22.0026 33.3 22.4996 33.3Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M25.1998 33.3C25.6969 33.3 26.0998 32.8971 26.0998 32.4C26.0998 31.9029 25.6969 31.5 25.1998 31.5C24.7027 31.5 24.2998 31.9029 24.2998 32.4C24.2998 32.8971 24.7027 33.3 25.1998 33.3Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M27.9 33.3C28.3971 33.3 28.8 32.8971 28.8 32.4C28.8 31.9029 28.3971 31.5 27.9 31.5C27.4029 31.5 27 31.9029 27 32.4C27 32.8971 27.4029 33.3 27.9 33.3Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M30.6002 33.3C31.0973 33.3 31.5002 32.8971 31.5002 32.4C31.5002 31.9029 31.0973 31.5 30.6002 31.5C30.1031 31.5 29.7002 31.9029 29.7002 32.4C29.7002 32.8971 30.1031 33.3 30.6002 33.3Z"
                                                        fill="#EAB8C0" />
                                                    <path
                                                        d="M33.3004 33.3C33.7974 33.3 34.2004 32.8971 34.2004 32.4C34.2004 31.9029 33.7974 31.5 33.3004 31.5C32.8033 31.5 32.4004 31.9029 32.4004 32.4C32.4004 32.8971 32.8033 33.3 33.3004 33.3Z"
                                                        fill="#EAB8C0" />
                                                </svg>
                                            </div>
                                            <div class="status-flow-text">order received</div>
                                            <div class="status-flow-date">
                                                {{ $order->created_at->format('d M Y H:i') }}
                                            </div>
                                        </div>
                                        <div class="status-flow">
                                            <div
                                                class="status-flow-icon {{ $order->order_status_id == 2 ? 'status-flow-icon-pending' : ($order->order_status_id > 2 ? 'status-flow-icon-finish' : '') }}">
                                                <svg width="30" height="30" viewBox="0 0 45 45" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.5 6.2998C2.025 6.2998 0 8.3248 0 10.7998V34.1998C0 36.6748 2.025 38.6998 4.5 38.6998H40.5C42.975 38.6998 45 36.6748 45 34.1998V10.7998C45 8.3248 42.975 6.2998 40.5 6.2998H4.5ZM4.5 8.0998H40.5C42.0012 8.0998 43.2 9.29863 43.2 10.7998V34.1998C43.2 35.701 42.0012 36.8998 40.5 36.8998H4.5C2.99883 36.8998 1.8 35.701 1.8 34.1998V10.7998C1.8 9.29863 2.99883 8.0998 4.5 8.0998Z"
                                                        fill="{{ $order->order_status_id == 2 ? 'white' : ($order->order_status_id > 2 ? '#EAB8C0' : '#9a9caa') }}" />
                                                    <path
                                                        d="M14.1985 27V16.0909H18.087C18.9322 16.0909 19.6335 16.2365 20.1911 16.5277C20.7521 16.8189 21.1712 17.2219 21.4482 17.7369C21.7251 18.2482 21.8636 18.8395 21.8636 19.5107C21.8636 20.1783 21.7234 20.766 21.4428 21.2738C21.1658 21.7781 20.7468 22.1705 20.1857 22.451C19.6282 22.7315 18.9268 22.8718 18.0817 22.8718H15.136V21.4549H17.9325C18.4652 21.4549 18.8984 21.3786 19.2322 21.2259C19.5696 21.0732 19.8164 20.8512 19.9727 20.56C20.1289 20.2688 20.207 19.919 20.207 19.5107C20.207 19.0987 20.1271 18.7418 19.9673 18.44C19.8111 18.1381 19.5643 17.9073 19.2269 17.7475C18.8931 17.5842 18.4545 17.5025 17.9112 17.5025H15.8445V27H14.1985ZM19.5838 22.0781L22.2791 27H20.4041L17.7621 22.0781H19.5838ZM23.7386 30.0682V18.8182H25.294V20.1445H25.4272C25.5195 19.9741 25.6527 19.777 25.8267 19.5533C26.0007 19.3295 26.2422 19.1342 26.5511 18.9673C26.8601 18.7969 27.2685 18.7116 27.7763 18.7116C28.4368 18.7116 29.0263 18.8786 29.5447 19.2124C30.0632 19.5462 30.4698 20.0273 30.7646 20.6559C31.0629 21.2844 31.212 22.0408 31.212 22.9251C31.212 23.8093 31.0646 24.5675 30.7699 25.1996C30.4751 25.8281 30.0703 26.3129 29.5554 26.6538C29.0405 26.9911 28.4528 27.1598 27.7923 27.1598C27.2951 27.1598 26.8885 27.0763 26.5724 26.9094C26.2599 26.7425 26.0149 26.5472 25.8374 26.3235C25.6598 26.0998 25.5231 25.9009 25.4272 25.7269H25.3313V30.0682H23.7386ZM25.2994 22.9091C25.2994 23.4844 25.3828 23.9886 25.5497 24.4219C25.7166 24.8551 25.9581 25.1942 26.2741 25.4393C26.5902 25.6808 26.9773 25.8015 27.4354 25.8015C27.9112 25.8015 28.3089 25.6754 28.6286 25.4233C28.9482 25.1676 29.1896 24.8214 29.353 24.3846C29.5199 23.9478 29.6033 23.456 29.6033 22.9091C29.6033 22.3693 29.5217 21.8846 29.3583 21.4549C29.1985 21.0252 28.957 20.6861 28.6339 20.4375C28.3143 20.1889 27.9148 20.0646 27.4354 20.0646C26.9737 20.0646 26.5831 20.1836 26.2635 20.4215C25.9474 20.6594 25.7077 20.9915 25.5444 21.4176C25.381 21.8437 25.2994 22.3409 25.2994 22.9091Z"
                                                        fill="{{ $order->order_status_id == 2 ? 'white' : ($order->order_status_id > 2 ? '#EAB8C0' : '#9a9caa') }}" />
                                                </svg>
                                            </div>
                                            <div class="status-flow-text">order paid</div>
                                            <div class="status-flow-date">
                                                {{ $order->order_status_id >= 2? $order->orderStatusHistories->where('order_status_id', 2)->first()->created_at->format('d M Y H:i'): '' }}
                                            </div>
                                        </div>
                                        <div class="status-flow">
                                            <div
                                                class="status-flow-icon {{ $order->order_status_id == 3 ? 'status-flow-icon-pending' : ($order->order_status_id > 3 ? 'status-flow-icon-finish' : '') }}">
                                                <svg width="30" height="30" viewBox="0 0 50 50" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_679_337)">
                                                        <path
                                                            d="M28.9684 1.21875C28.7809 1.25391 28.6091 1.33984 28.4684 1.46875L24.2497 5.09375L22.8122 3.5C22.6169 3.27344 22.3278 3.14844 22.0309 3.15625C21.7809 3.17578 21.5466 3.28516 21.3747 3.46875L18.8747 6H15.4684C15.4372 6 15.4059 6 15.3747 6C15.3434 6 15.3122 6 15.2809 6C15.1208 6.03516 14.9684 6.10937 14.8434 6.21875L4.68719 14.0312L4.62469 14.0625C4.61297 14.0742 4.60515 14.082 4.59344 14.0938C4.58172 14.0938 4.5739 14.0938 4.56219 14.0938C4.51922 14.1133 4.47625 14.1328 4.43719 14.1562C4.42547 14.168 4.41765 14.1758 4.40594 14.1875C4.3825 14.207 4.36297 14.2266 4.34344 14.25C4.30828 14.2773 4.27703 14.3086 4.24969 14.3438C4.21453 14.3828 4.18328 14.4258 4.15594 14.4688C4.14422 14.4883 4.1325 14.5117 4.12469 14.5312C4.11297 14.543 4.10515 14.5508 4.09344 14.5625C4.07 14.6133 4.04656 14.6641 4.03094 14.7188L0.0934351 22.5625C-0.101878 22.9492 -0.0276587 23.4141 0.277029 23.7227C0.585623 24.0273 1.05047 24.1016 1.43719 23.9062L3.99969 22.625V43C3.99969 43.5508 4.4489 44 4.99969 44H34.9997C35.0114 44 35.0192 44 35.0309 44C35.0934 43.9961 35.1559 43.9844 35.2184 43.9688C35.2497 43.9609 35.2809 43.9492 35.3122 43.9375C35.5622 43.8633 35.777 43.6953 35.9059 43.4688L43.7809 33.625C43.9216 33.4492 43.9997 33.2266 43.9997 33V23.4375L49.7184 17.7188C50.0348 17.3867 50.0856 16.8867 49.8434 16.5L44.0309 6.8125C44.0231 6.78125 44.0114 6.75 43.9997 6.71875C43.9567 6.57812 43.8786 6.45312 43.7809 6.34375C43.7731 6.32422 43.7614 6.30078 43.7497 6.28125C43.738 6.28125 43.7302 6.28125 43.7184 6.28125C43.7106 6.26172 43.6989 6.23828 43.6872 6.21875C43.6755 6.21875 43.6677 6.21875 43.6559 6.21875C43.6364 6.20703 43.613 6.19531 43.5934 6.1875C43.5934 6.17578 43.5934 6.16797 43.5934 6.15625C43.5817 6.15625 43.5739 6.15625 43.5622 6.15625C43.5114 6.12109 43.4606 6.08984 43.4059 6.0625C43.3942 6.0625 43.3864 6.0625 43.3747 6.0625C43.3552 6.05078 43.3317 6.03906 43.3122 6.03125C43.3005 6.03125 43.2927 6.03125 43.2809 6.03125C43.2614 6.01953 43.238 6.00781 43.2184 6C43.2067 6 43.1989 6 43.1872 6C43.1677 6 43.1442 6 43.1247 6C43.113 6 43.1052 6 43.0934 6C43.0739 6 43.0505 6 43.0309 6C43.0192 6 43.0114 6 42.9997 6H42.9372C42.9177 6 42.8942 6 42.8747 6H34.0309L29.8434 1.5625C29.6677 1.35937 29.4216 1.23828 29.1559 1.21875C29.0934 1.21094 29.0309 1.21094 28.9684 1.21875ZM29.0622 3.59375L36.7809 11.7812L34.5622 14H32.1559C32.1286 13.9648 32.0973 13.9336 32.0622 13.9062L25.5622 6.59375L29.0622 3.59375ZM22.0309 5.625L29.4997 14H13.8434L22.0309 5.625ZM15.7809 8H16.9372L11.0309 14H7.93719L15.7809 8ZM35.9059 8H40.5622L38.1559 10.4062L35.9059 8ZM42.8122 8.625L47.7497 16.8125L41.1872 23.375L36.2497 15.1875L42.8122 8.625ZM5.99969 16H33.9997V42H5.99969V21.125C6.00359 21.082 6.00359 21.043 5.99969 21V16ZM35.9997 18.5625L40.1559 25.5C40.3083 25.7656 40.5778 25.9492 40.8825 25.9922C41.1872 26.0352 41.4958 25.9336 41.7184 25.7188L41.9997 25.4375V32.6562L35.9997 40.1562V18.5625ZM3.99969 19.25V20.375L3.24969 20.75L3.99969 19.25ZM14.7184 20C14.1677 20.0781 13.7809 20.5898 13.8591 21.1406C13.9372 21.6914 14.4489 22.0781 14.9997 22H24.9997C25.3591 22.0039 25.695 21.8164 25.8786 21.5039C26.0583 21.1914 26.0583 20.8086 25.8786 20.4961C25.695 20.1836 25.3591 19.9961 24.9997 20H14.9997C14.9684 20 14.9372 20 14.9059 20C14.8747 20 14.8434 20 14.8122 20C14.7809 20 14.7497 20 14.7184 20Z"
                                                            fill="{{ $order->order_status_id == 3 ? 'white' : ($order->order_status_id > 3 ? '#EAB8C0' : '#9a9caa') }}" />
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="status-flow-text">order prepared</div>
                                            <div class="status-flow-date">
                                                {{ $order->order_status_id >= 3? $order->orderStatusHistories->where('order_status_id', 3)->first()->created_at->format('d M Y H:i'): '' }}
                                            </div>
                                        </div>
                                        <div class="status-flow">
                                            <div
                                                class="status-flow-icon {{ $order->order_status_id == 4 ? 'status-flow-icon-pending' : ($order->order_status_id > 4 ? 'status-flow-icon-finish' : '') }}">
                                                <svg width="32" height="23" viewBox="0 0 50 37" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0 0V2H28.0938C28.4922 2 29 2.50781 29 2.90625V30H18.9062C18.4297 27.1641 15.9648 25 13 25C10.0352 25 7.57031 27.1641 7.09375 30H3C2.44531 30 2 29.5547 2 29V20H0V29C0 30.6445 1.35547 32 3 32H7.09375C7.57031 34.8359 10.0352 37 13 37C15.9648 37 18.4297 34.8359 18.9062 32H34.0938C34.5703 34.8359 37.0352 37 40 37C42.9648 37 45.4297 34.8359 45.9062 32H47C47.832 32 48.5625 31.625 49.0938 31.0938C49.625 30.5625 50 29.832 50 29V19.4062C50 18.2812 49.5703 17.25 49.1875 16.4688C48.8047 15.6875 48.4062 15.125 48.4062 15.125V15.0938L44.3125 9.59375H44.2812V9.5625C43.3945 8.45312 41.9727 7 40 7H32C31.6406 7 31.3125 7.06641 31 7.1875V2.90625C31 1.30469 29.6953 0 28.0938 0H0ZM0 4V6H18V4H0ZM0 8V10H15V8H0ZM32 9H36V18C36 18.832 36.375 19.5625 36.9062 20.0938C37.4375 20.625 38.168 21 39 21H48V29C48 29.168 47.875 29.4375 47.6562 29.6562C47.4375 29.875 47.168 30 47 30H45.9062C45.4297 27.1641 42.9648 25 40 25C37.0352 25 34.5703 27.1641 34.0938 30H31V10C31 9.83203 31.125 9.5625 31.3438 9.34375C31.5625 9.125 31.832 9 32 9ZM38 9H40C40.8242 9 41.9727 9.92578 42.6875 10.8125L46.7812 16.2812L46.8125 16.3125C46.832 16.3398 47.1016 16.7227 47.4062 17.3438C47.6602 17.8594 47.793 18.4727 47.875 19H39C38.832 19 38.5625 18.875 38.3438 18.6562C38.125 18.4375 38 18.168 38 18V9ZM0 12V14H12V12H0ZM0 16V18H9V16H0ZM13 27C15.2227 27 17 28.7773 17 31C17 33.2227 15.2227 35 13 35C10.7773 35 9 33.2227 9 31C9 28.7773 10.7773 27 13 27ZM40 27C42.2227 27 44 28.7773 44 31C44 33.2227 42.2227 35 40 35C37.7773 35 36 33.2227 36 31C36 28.7773 37.7773 27 40 27Z"
                                                        fill="{{ $order->order_status_id == 4 ? 'white' : ($order->order_status_id > 4 ? '#EAB8C0' : '#9a9caa') }}" />
                                                </svg>
                                            </div>
                                            <div class="status-flow-text">Order Delivered</div>
                                            <div class="status-flow-date">
                                                {{ $order->order_status_id >= 4? $order->orderStatusHistories->where('order_status_id', 4)->first()->created_at->format('d M Y H:i'): '' }}
                                            </div>
                                        </div>
                                        <div class="status-flow">
                                            <div
                                                class="status-flow-icon {{ $order->order_status_id == 5 ? 'status-flow-icon-pending' : ($order->order_status_id > 5 ? 'status-flow-icon-finish' : '') }}">
                                                <svg width="50" height="50" viewBox="0 0 100 100" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M57.3383 27.0001C54.1101 27.0001 51.4717 29.8912 51.4717 33.4287V45.8423L46.2963 40.1712C46.2052 40.0686 46.0963 39.987 45.9759 39.9313C45.8555 39.8756 45.7261 39.8469 45.5955 39.8469C45.401 39.8469 45.2109 39.9105 45.0495 40.0296C44.8882 40.1486 44.7629 40.3177 44.6897 40.5152C44.6165 40.7127 44.5988 40.9296 44.6387 41.1382C44.6785 41.3468 44.7743 41.5376 44.9137 41.6863L51.6722 49.0922C51.7636 49.2234 51.8814 49.3298 52.0165 49.4029C52.1515 49.4761 52.3002 49.514 52.4509 49.5138C52.6015 49.5136 52.7501 49.4752 52.885 49.4017C53.0199 49.3282 53.1375 49.2216 53.2286 49.0901L59.9852 41.6863C60.079 41.5876 60.1539 41.4693 60.2056 41.3385C60.2572 41.2076 60.2844 41.0668 60.2858 40.9242C60.2871 40.7817 60.2624 40.6403 60.2133 40.5083C60.1641 40.3763 60.0914 40.2564 59.9994 40.1556C59.9074 40.0548 59.798 39.9752 59.6775 39.9213C59.5571 39.8674 59.4281 39.8404 59.298 39.8418C59.1679 39.8433 59.0394 39.8732 58.92 39.9297C58.8006 39.9863 58.6926 40.0684 58.6025 40.1712L53.4272 45.8423V33.4287C53.4272 31.0497 55.1673 29.143 57.3383 29.143H68.0938C68.2234 29.145 68.352 29.1188 68.4723 29.0658C68.5925 29.0129 68.7019 28.9343 68.7942 28.8346C68.8865 28.7349 68.9597 28.6161 69.0098 28.4851C69.0598 28.3541 69.0855 28.2135 69.0855 28.0715C69.0855 27.9295 69.0598 27.789 69.0098 27.658C68.9597 27.527 68.8865 27.4082 68.7942 27.3085C68.7019 27.2088 68.5925 27.1302 68.4723 27.0773C68.352 27.0243 68.2234 26.9981 68.0938 27.0001H57.3383ZM68.2485 50.5549C68.0704 50.5578 67.8929 50.5758 67.7157 50.6072C67.2431 50.691 66.7783 50.8786 66.3503 51.1743L55.4973 58.5028C55.2468 58.3527 54.9397 58.1869 54.5348 57.9733C54.0697 57.7279 53.5832 57.4775 53.3088 57.3414C51.8317 56.6094 47.1224 54.4794 43.5483 52.7606C42.0193 52.0253 40.3851 51.6495 38.7491 51.6326C37.1132 51.6157 35.4741 51.9583 33.9328 52.6622L27.6289 55.5396C27.5076 55.5916 27.3969 55.6696 27.3035 55.769C27.2101 55.8685 27.1357 55.9874 27.0848 56.1188C27.0339 56.2502 27.0075 56.3914 27.007 56.5341C27.0066 56.6768 27.0322 56.8182 27.0823 56.95C27.1325 57.0817 27.2061 57.2011 27.2989 57.3013C27.3918 57.4014 27.5019 57.4802 27.6229 57.533C27.7439 57.5859 27.8733 57.6117 28.0036 57.6089C28.1338 57.6062 28.2622 57.575 28.3813 57.5171L34.6853 54.6398C37.2757 53.4568 40.1914 53.4875 42.7615 54.7235C46.37 56.4589 51.1562 58.6265 52.5029 59.2938C52.7448 59.4138 53.2333 59.6655 53.6869 59.9049C54.1406 60.1442 54.6175 60.4091 54.6571 60.4343C55.0933 60.7123 55.3828 61.2101 55.3828 61.8092C55.3828 62.71 54.7382 63.4163 53.9161 63.4163C53.7996 63.4163 53.689 63.402 53.5838 63.3745H53.5819C53.5572 63.368 52.7837 63.13 51.846 62.8283C50.9083 62.5266 49.7151 62.1392 48.5422 61.7568C46.1962 60.9922 43.9302 60.2481 43.9302 60.2481C43.6818 60.1665 43.4139 60.1964 43.1856 60.3312C42.9573 60.466 42.7872 60.6946 42.7128 60.9669C42.6383 61.2391 42.6656 61.5326 42.7886 61.7828C42.9116 62.033 43.1203 62.2193 43.3687 62.3009C43.3687 62.3009 45.6381 63.0443 47.9864 63.8097C49.1606 64.1924 50.3541 64.5802 51.296 64.8833C52.2369 65.186 52.8359 65.3825 53.1293 65.4587C53.3839 65.5254 53.6474 65.5592 53.9161 65.5592C55.7946 65.5592 57.3383 63.8676 57.3383 61.8092C57.3383 61.1747 57.1871 60.5785 56.9296 60.0534L67.3853 52.9928C67.3885 52.9908 67.3917 52.9887 67.3949 52.9866C68.2132 52.4211 69.2662 52.6824 69.782 53.5788C70.2831 54.4491 70.0736 55.5683 69.3008 56.1527C69.2885 56.1615 69.2764 56.1706 69.2645 56.1799L53.8416 68.9848C52.7888 69.8595 51.4091 70.0947 50.1635 69.6105L38.774 65.1867C36.1405 63.9957 33.1266 64.3968 30.8296 66.2435L27.4226 68.9827C27.3149 69.0642 27.2232 69.1685 27.1529 69.2894C27.0827 69.4104 27.0353 69.5456 27.0136 69.687C26.9918 69.8284 26.9962 69.9731 27.0265 70.1127C27.0568 70.2522 27.1123 70.3836 27.1898 70.4992C27.2672 70.6147 27.3651 70.7121 27.4775 70.7854C27.5899 70.8588 27.7147 70.9067 27.8443 70.9263C27.9739 70.9459 28.1058 70.9368 28.2322 70.8995C28.3586 70.8622 28.4768 70.7975 28.5799 70.7092L31.9868 67.972C33.7359 66.5659 36.0222 66.2616 38.0273 67.1684C38.0424 67.1751 38.0577 67.1814 38.0731 67.1873L49.5104 71.6299C51.3741 72.3544 53.4483 72.0014 55.0237 70.6924L70.4103 57.9168C72.0291 56.6927 72.4855 54.2595 71.4358 52.4362C70.7271 51.2048 69.495 50.5346 68.2485 50.5549Z"
                                                        fill="{{ $order->order_status_id == 5 ? 'white' : ($order->order_status_id > 5 ? '#EAB8C0' : '#9a9caa') }}" />
                                                </svg>
                                            </div>
                                            <div class="status-flow-text">Order Completed</div>
                                            <div class="status-flow-date">
                                                {{ $order->order_status_id >= 5? $order->orderStatusHistories->where('order_status_id', 5)->first()->created_at->format('d M Y H:i'): '' }}
                                            </div>
                                        </div>
                                        <div class="status-flow-line">
                                            <div class="status-flow-line-background"></div>
                                            <div class="status-flow-line-foreground">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-gap"></div>
                                <div>
                                    <div class="order-detail-data">
                                        <div class="garis-garis"></div>
                                    </div>
                                    <div class="order-detail-data-wrap">
                                        <div class="order-detail-data-delivery">
                                            <div class="data-delivery-title">delivery address</div>
                                            <div class="data-delivery-courier-wrap">
                                                <div class="data-delivery-courier">
                                                    <div>
                                                        <div>
                                                            {{ $order->courier == 'jne' ? 'JNE' : ($order->courier == 'pos' ? 'Pos Indonesia' : 'TIKI') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-detail-cust-wrap">
                                            <div class="order-detail-cust">
                                                <div class="order-detail-cust-name">{{ $order->address_name }}</div>
                                                <div class="order-detail-cust-addr">
                                                    <span>{{ $order->address_phone }} </span>
                                                    {{ $order->address_address }}
                                                    {{ $order->address_city }},&nbsp;{{ $order->address_province }},&nbsp;{{ $order->address_postal_code }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @foreach ($order->orderItems()->with('product')->get() as $orderItem)
                                        <div>
                                            <div class="order-detail-product-wrap">
                                                <div class="order-detail-product-gap"></div>
                                                <div class="order-detail-product">
                                                    <div>
                                                        <a class="order-detail-product-item"
                                                            href="{{ route('product-details.show', $orderItem->product->id) }}">
                                                            <div class="product-item-detail-wrap">
                                                                <div class="product-item-detail">
                                                                    <div class="product-item-detail-img">
                                                                        <div class="item-detail-img-content"
                                                                            style="background-image: url({{ asset('storage/' . $orderItem->product->images[0]) }})">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-detail-text">
                                                                    <div>
                                                                        <div class="item-detail-title-wrap">
                                                                            <span class="item-detail-title">
                                                                                {{ $orderItem->product->name }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="item-detail-category">
                                                                            {{ $orderItem->product->agency->name }}
                                                                        </div>
                                                                        <div class="item-detail-qty">
                                                                            x{{ $orderItem->quantity }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-detail-price-wrap">
                                                                <div>
                                                                    <span class="item-detail-price">Rp.
                                                                        {{ number_format($orderItem->items_price, 0, '.', '.') }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                    <div class="item-detail-total-wrap">
                                        <div class="item-detail-row">
                                            <div class="item-detail-col">
                                                <span>Subtotal</span>
                                            </div>
                                            <div class="item-detail-amount">
                                                <div>
                                                    Rp. {{ number_format($order->total_amount, 0, '.', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-detail-row">
                                            <div class="item-detail-col">
                                                <span>Shipping Fee</span>
                                            </div>
                                            <div class="item-detail-amount">
                                                <div>
                                                    Rp. {{ number_format($order->shipping_cost, 0, '.', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-detail-row item-detail-total-wrap">
                                            <div class="item-detail-col item-detail-total">
                                                <span>Order Total</span>
                                            </div>
                                            <div class="item-detail-amount">
                                                <div class="item-detail-amount-total">
                                                    Rp.
                                                    {{ number_format($order->total_amount + $order->shipping_cost, 0, '.', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
