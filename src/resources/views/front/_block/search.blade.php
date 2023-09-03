<div class="search-block">
    {{-- Search Header --}}
    <div class="search-header">
        {{-- Search Bar --}}
        <div class="search-bar">
            <form id="searchForm" action="" class="search-form">
                <label for="searchInput" class="search-label">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                </label>
                <input type="search" id="searchInput" placeholder="Search " class="search-input">
            </form>
            <div id="mobileModalClose" class="mobile-modal-close">Close</div>
        </div>
        {{-- Suggestion Bar --}}
        <div class="suggestion-bar">
            <span>検索候補:</span>
            <ul class="suggestion-list">
                <li class="suggestion-item">laravel</li>
                <li class="suggestion-item">composer</li>
                <li class="suggestion-item">install</li>
            </ul>
        </div>
        {{-- Search Scope Bar --}}
        <div class="search-scope-bar">
            <span class="scope-label">検索範囲:</span>
            <ul class="scope-list">
                <li class="scope-item">
                    <input class="scope-radio" type="radio" id="titleMatch" name="searchScope" value="title" checked>
                    <label class="scope-label-item" for="titleMatch">タイトル</label>
                </li>
                <li class="scope-item">
                    <input class="scope-radio" type="radio" id="contentMatch" name="searchScope" value="content">
                    <label class="scope-label-item" for="contentMatch">記事内</label>
                </li>
                <li class="scope-item">
                    <input class="scope-radio" type="radio" id="fullRange" name="searchScope" value="all">
                    <label class="scope-label-item" for="fullRange">全範囲</label>
                </li>
            </ul>
        </div>
    </div>
    {{-- Search Body --}}
    <div class="search-body">
        <div class="search-result-label">検索結果:</div>
        <ul class="search-results">
            {{-- <a href=""><li class="search-result-item"></li></a> --}}
        </ul>
    </div>
</div>
