<div class="user-mid">
    <div class="side_title">MY PAGE</div>
    <ul class="first_ul">
        <li class="first_li">My Account</li>
        <li>
            <a href="{{ route('orders') }}" class="{{ Request::is('user/orders') ? 'usermid-act' : '' }}">Order History
            </a>
        </li>
        <li>
            <a href="{{ route('wishlist.show') }}">Wish List </a>
        </li>
    </ul>
    <ul>
        <li class="first_li">My Profile</li>
        <li>
            <a href="{{ route('profile') }}" class="{{ Request::is('user/profile') ? 'usermid-act' : '' }}">Edit Profile
            </a>
        </li>
        <li>
            <a href="{{ route('addresses.index') }}"
                class="{{ Request::is('user/address*') ? 'usermid-act' : '' }}">Address
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">Logout </a>
        </li>
    </ul>
</div>
