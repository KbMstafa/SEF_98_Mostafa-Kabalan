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
        if (theUrl == "") {
            document.getElementById("url").focus();
            document.getElementById("url").placeholder = "Please enter a URL";
        } else {
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
        }
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
    },
    summarization: function (text, title) {
        var http = new XMLHttpRequest();
        var sentences_number = document.getElementById("sentencesNumber").value;
        var url = "summarize.php";
        var params = "text=" 
                    + text + 
                    "&title=" 
                    + title + 
                    "&sentences_number=" 
                    + sentences_number;
        http.open("POST", url, true);

        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                var summarizedText = http.responseText;
                summarize.display(title, summarizedText);
            }
        }
        http.send(params)
    },
    display: function(title, text) {
        var section = document.getElementById("output");

        section.innerHTML = "<h2>" + title + "</h2><p>" + text + "</p>"
    }
}

summarize.init();