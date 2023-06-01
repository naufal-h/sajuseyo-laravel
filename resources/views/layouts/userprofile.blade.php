        <div class="clear-both user-top">
            <div class="width1140">
                <div class="user-topleft">
                    <div class="pfp" style="display: block">

                        @if (auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" />
                        @else
                            <img src="assets/detprod/manyun.jpg" />
                        @endif
                        <div class="overlay" onclick="document.getElementById('profile-picture-input').click()">
                            <span class="change-pfp-text">Change Profile
                                Pic</span>
                        </div>
                        <form action="{{ route('users.updateProfilePicture', auth()->user()->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input id="profile-picture-input" type="file" name="profile_picture"
                                style="display: none;" onchange="this.form.submit()">
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
                                <a href="./orders.html" class="count">
                                    <span>{{ auth()->user()->orders->count() }}</span>
                                </a>
                            </li>
                            <li>
                                <strong>Cancel/Exchange/Return</strong>
                                <a class="count"><span>0</span>/<span>0</span>/<span>0</span></a>
                            </li>
                            <li>
                                <strong>Coupon</strong>
                                <a href="coupon.html" class="count"><span>0</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
