@if (Request::is('category/*'))
    <div class="sidebar">
        <div class="text-label">Product</div>
        <hr />
        <div class="product-nav-lists">
            <div>
                <a href="{{ route('products.category', ['categoryId' => 1]) }}"
                    class="product-category-link {{ Request::is('category/1') ? 'active-category' : '' }}">Music</a>
            </div>
            <div>
                <a href="{{ route('products.category', ['categoryId' => 2]) }}"
                    class="product-category-link {{ Request::is('category/2') ? 'active-category' : '' }}">Fanlight</a>
            </div>
            <div r>
                <a href="{{ route('products.category', ['categoryId' => 3]) }}"
                    class="product-category-link {{ Request::is('category/3') ? 'active-category' : '' }}">Photo
                    Book</a>
            </div>
            <div>
                <a href="{{ route('products.category', ['categoryId' => 4]) }}"
                    class="product-category-link {{ Request::is('category/4') ? 'active-category' : '' }}">Printed
                    Photo</a>
            </div>
        </div>
    </div>
@elseif(Request::is('agency/*'))
    <div class="sidebar">
        <div class="text-label">Celeb</div>
        <hr />
        <div class="product-nav-lists">
            <div>
                <a href="{{ route('products.agency', ['agencyId' => 1]) }}"
                    class="product-category-link {{ Request::is('agency/1') ? 'active-category' : '' }}">SM Ent.</a>
            </div>
            <div>
                <a href="{{ route('products.agency', ['agencyId' => 2]) }}"
                    class="product-category-link {{ Request::is('agency/2') ? 'active-category' : '' }}">JYP Ent.</a>
            </div>
            <div>
                <a href="{{ route('products.agency', ['agencyId' => 3]) }}"
                    class="product-category-link {{ Request::is('agency/3') ? 'active-category' : '' }}">YG Ent.</a>
            </div>
            <div>
                <a href="{{ route('products.agency', ['agencyId' => 4]) }}"
                    class="product-category-link {{ Request::is('agency/4') ? 'active-category' : '' }}">HYBE Corp.</a>
            </div>
            <div>
                <a href="{{ route('products.agency', ['agencyId' => 5]) }}"
                    class="product-category-link {{ Request::is('agency/5') ? 'active-category' : '' }}">Cube Ent.</a>
            </div>
            <div>
                <a href="{{ route('products.agency', ['agencyId' => 6]) }}"
                    class="product-category-link {{ Request::is('agency/6') ? 'active-category' : '' }}">Others</a>
            </div>
        </div>
    </div>
@elseif(Request::is('wishlist'))
    <div class="sidebar">
        <div class="text-label">Wishlist</div>
        <hr />
    </div>
@elseif(Request::is('*/search*'))
    <div class="sidebar">
        <div class="text-label"><span style="color: #eab8c0">
                {{ $products->total() }}
            </span>Results Were Found</div>
        <hr />
    </div>
@elseif(Request::is('*/deals'))
    <div class="sidebar">
        <div class="text-label">
            Grab Your Deals
            <span style="color: #eab8c0">
                Now!
            </span>
            <hr />
        </div>
    </div>
@endif
