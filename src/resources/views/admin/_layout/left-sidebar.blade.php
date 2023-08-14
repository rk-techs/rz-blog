<div class="left-sidebar">
    <ul class="menu-list">
        <li class="menu-item"><a href="{{ route('home') }}" class="menu-link">Front</a></li>
        <li class="menu-item {{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}" class="menu-link">Dashboard</a></li>
        <li class="menu-item {{ Route::is('admin.category.*') ? 'active' : '' }}"><a href="{{ route('admin.category.index') }}" class="menu-link">Category</a></li>
        <li class="menu-item {{ Route::is('admin.post.*') ? 'active' : '' }}"><a href="{{ route('admin.post.index') }}" class="menu-link">Post</a></li>
    </ul>

    <div class="logout-block">
        <form method="POST" action="{{ route('logout')}}">
            @csrf
            <button class="btn menu-logout">Logout</button>
        </form>
    </div>
</div>

