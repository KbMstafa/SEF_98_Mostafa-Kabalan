var summarize = {
    HPregex: /(<h(2|3) (.*?)>(.*?)<\/h(2|3)>|<p (.*?)>(.*?)<\/p>|<li (.*?)>(.*?)<\/li>)/g,
    Hregex: /<h1 (.*?)>(.*?)<\/h1>/,
    removeTagsRegex: /(<(.*?)>|<\/(.*?))>/g,
    init: function() {
        var getButton = document.getElementById("get");
        get.addEventListener("click", this.getContents);
    },
    getContents: function () {
        theUrl = document.getElementById("url").value;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5`
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var htmlCode = xmlhttp.responseText;
                summarize.extractContent(htmlCode);
            }
        }
        xmlhttp.open("GET", "proxy.php?url=" + theUrl, true);
        xmlhttp.send(); 
    },
    extractContent: function(content)
    {
        var filtered = content.match(this.HPregex);

        var span = document.createElement('span');

        span.innerHTML = filtered;

        var parsing = [span.textContent || span.innerText].toString();
        var cleanupParsing = parsing.replace(/(\. ,)/g,". ");
        var title = content.match(this.Hregex)[2];

        summarize.summarization(cleanupParsing, title);
    }
}

summarize.init();