<div class="clear-both user-top">
    <div class="width1140">
        <div class="user-topleft">
            <div class="pfp" style="display: block">

                @if (auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" />
                @else
                    <img src="https://dummyimage.com/765x765/eab8c1/ffffff.jpg&text=Insert+Image+Here+(1:1+Ratio)" />
                @endif
                <div class="overlay" onclick="document.getElementById('profile-picture-input').click()">
                    <span class="change-pfp-text">Change Profile
                        Pic</span>
                </div>
                <form action="{{ route('users.updateProfilePicture', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input id="profile-picture-input" type="file" name="profile_picture" style="display: none;"
                        onchange="this.form.submit()">
                </form>
            </div>
        </div>

        <div class="user-topright" style="float: right">
            <div class="usn">
                <strong><span>
                        {{ auth()->user()->name }}

                    </span></strong>
            </div>

            <div class="user-stats">
                <ul class="order">
                    <li>
                        <strong>Order History</strong>
                        <a href="{{ route('orders') }}" class="count">
                            <span>{{ auth()->user()->orders->count() }}</span>
                        </a>
                    </li>
                    <li>
                        <strong>Date Joined</strong>
                        <a class="count"><span>
                                {{ auth()->user()->created_at->format('d M Y') }}
                            </span></a>
                    </li>
                    <li>
                        <strong>Wishlist</strong>
                        <a href="{{ route('wishlist.show') }}" class="count">
                            <span>{{ auth()->user()->wishlist()->withCount('wishlistItems')->first()->wishlist_items_count }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
