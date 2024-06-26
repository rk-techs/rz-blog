<div class="profile-block">
    <div class="profile-content">
        <div class="profile-icon">
            <a href="{{ route('pages.profile') }}">
                <img src="{{ asset('images/profile-icon.png') }}" alt="Profile Icon" class="image-profile">
            </a>
        </div>
        <div class="author-info">
            <a href="{{ route('pages.profile') }}" class="nickname">Ryosuke</a>
        </div>
        <div class="sns-icons">
            <a href="{{ config('myconf.my_twitter') }}" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('images/Logo blue.svg') }}" alt="X Logo" class="icon-twitter">
            </a>
            <a href="{{ config('myconf.my_github') }}" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('images/logo-github.svg') }}" alt="GitHub Logo" class="icon-github">
            </a>
        </div>
    </div>
</div>

