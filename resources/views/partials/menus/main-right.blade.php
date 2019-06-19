<ul>
    @guest
    <li><a href="{{ route('register') }}">註冊</a></li>
    <li><a href="{{ route('login') }}">登入</a></li>
    @else
    <li><a href="{{ route('users.profile.edit') }}">我的帳戶</a></li>
    <li>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            登出
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @endguest
</ul>