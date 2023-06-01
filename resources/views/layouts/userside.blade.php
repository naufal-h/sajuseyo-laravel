<div class="user-mid">
    <div class="side_title">MY PAGE</div>
    <ul class="first_ul">
        <li class="first_li">My Account</li>
        <li>
            <a href="./orders.html">Order History </a>
        </li>
        <li>
            <a href="{{ route('wishlist.show') }}">Wish List </a>
        </li>
        <li>
            <a href="coupon.html">Coupons </a>
        </li>
    </ul>
    <ul>
        <li class="first_li">My Profile</li>
        <li>
            <a href="{{ route('profile') }}" class="{{ Request::is('profile') ? 'usermid-act' : '' }}">Edit Profile </a>
        </li>
        <li>
            <a href="{{ route('addresses.index') }}" class="{{ Request::is('address*') ? 'usermid-act' : '' }}">Address
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">Logout </a>
        </li>
    </ul>
</div>
