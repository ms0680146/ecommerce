<form action="{{ route('search') }}" method="GET" class="search-form">
    <i class="fa fa-search search-icon"></i>
    <input type="text" name="keyword" value="{{isset(request()->keyword) ? request()->keyword : ''}}" class="search-box" placeholder="請輸入欲搜尋的關鍵字" required>
    <button type="submit" class="btn btn-default">搜尋</button>
</form>