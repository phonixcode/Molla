<div class="my-account-navigation mb-50">
    <ul>
        <li class="{{ request()->is('user/dashboard') ? 'active' : '' }}">
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
        </li>
        <li class="{{ request()->is('user/orders') ? 'active' : '' }}">
            <a href="{{ route('user.order') }}">Orders</a>
        </li>
        <li class="{{ request()->is('user/addresses') ? 'active' : '' }}">
            <a href="{{ route('user.address') }}">Addresses</a>
        </li>
        <li class="{{ request()->is('user/account-details') ? 'active' : '' }}">
            <a href="{{ route('user.acct.detail') }}">Account Details</a>
        </li>
        <li><a href="{{ route('user.auth.logout') }}">Logout</a></li>
    </ul>
</div>
