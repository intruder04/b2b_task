var url = new URL("https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3")
console.log(url);
url.origin; // "https://www.somehost.com"
url.pathname; // /test/index.html
url.search;   // ?param1=4&param2=3&param3=2&param4=1&param5=3

var elToRemove = 3;

function parseSearchQuery(queryString) {
    var query = {};
    var pairs = (queryString[0] === '?' ? queryString.substr(1) : queryString).split('&');
    for (var i = 0; i < pairs.length; i++) {
        var pair = pairs[i].split('=');
        query[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
    }
    return query;
}

function sortObject(obj) {
    var arr = [];
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop)) {
            arr.push({
                'key': prop,
                'value': obj[prop]
            });
        }
    }
    arr.sort(function(a, b) { return a.value - b.value; });
    return arr;
}

function filter(obj) {
    for (var key in obj) {
        if (obj[key] == elToRemove) {
            delete obj[key];
        }
    }
    return obj;
}

function createUrlParam(pathname) {
    var res = "url" + '=' + encodeURIComponent(pathname);
    return res;
}

urlParam = createUrlParam(url.pathname);
parsedSearch= parseSearchQuery(url.search);
filteredSearch = filter(parsedSearch);
sortedSearch = sortObject(filteredSearch);

searchString = "/?";
sortedSearch.forEach(element => {
    searchString = searchString + element.key + "=" + element.value + "&";
});

finalUrl = url.origin + searchString + urlParam;
console.log(finalUrl);

// https://www.somehost.com/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html
