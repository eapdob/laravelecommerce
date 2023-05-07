(function () {
    var client = algoliasearch('SNWA7FUSO1', '1319fe7e2d8e4e227cef43d5fbcd092f');
    var index = client.initIndex('product');
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        {hint: false}, {
            source: autocomplete.sources.hits(index, {hitsPerPage: 10}),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <div class="algolia-result">
                            <span>
                                <img src="${window.location.origin}/storage/${suggestion.image}" alt="img" class="algolia-thumb">
                                ${suggestion._highlightResult.name.value}
                            </span>
                            <span>$${(suggestion.price / 100).toFixed(2)}</span>
                        </div>
                        <div class="algolia-details">
                            <span>${suggestion._highlightResult.details.value}</span>
                        </div>
                    `;

                    return markup;
                },
                empty: function (result) {
                    return 'Sorry, we did not find any results for "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
        window.location.href = window.location.origin + '/shop/' + suggestion.slug;
    });
    ;
})();
