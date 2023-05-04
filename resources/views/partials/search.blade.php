<form action="{{ route('search') }}" method="GET" class="search-form">
    <i class="fa fa-search search-icon"></i>
    <input type="text" name="query" id="query" class="search-box" value="{{ request()->input('query') }}" placeholder="Search for product">
</form>
