<style>
    .anactive {
        border-bottom: 2px solid rgb(14, 14, 14) !important;
    }
</style>

<ul class="account-nav">
    <li>
        <a
            href="{{ route('user.index') }}"
            class="menu-link menu-link_us-s {{ request()->routeIs('user.index') ? 'anactive' : '' }}"
            >Dashboard</a
        >
    </li>
    <li>
        <a
            href="{{ route('user.orders') }}"
            class="menu-link menu-link_us-s {{ request()->routeIs('user.orders') ? 'anactive' : '' }}"
            >Orders</a
        >
    </li>
    <li>
        <a
            href="{{ route('account.address') }}"
            class="menu-link menu-link_us-s {{ request()->routeIs('account.address') ? 'anactive' : '' }}"
            >Addresses</a
        >
    </li>
    <li>
        <a
            href="{{ route('account.detail') }}"
            class="menu-link menu-link_us-s {{ request()->routeIs('account.detail') ? 'anactive' : '' }}"
            >Account Details</a
        >
    </li>
    <li>
        <a href="account-wishlist.html" class="menu-link menu-link_us-s"
            >Wishlist</a
        >
    </li>
    <li>
        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
            <a
                href="login.html"
                class="menu-link menu-link_us-s"
                onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                >Logout</a
            >
        </form>
    </li>
</ul>
