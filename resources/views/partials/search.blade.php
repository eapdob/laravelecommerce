<algolia-autocomplete app-id="SNWA7FUSO1" api-key="1319fe7e2d8e4e227cef43d5fbcd092f" index-name="product" ></algolia-autocomplete>

<form action="{{ route('search') }}" method="GET" class="search-form">
    <i class="fa fa-search search-icon"></i>
    <input type="text" name="query" id="query" value="{{ request()->input('query') }}" class="search-box"
           placeholder="Search for product" required>
</form>
