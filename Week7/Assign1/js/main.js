var summarize = {
    
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
                console.log(htmlCode);
            }
        }
        xmlhttp.open("GET", "proxy.php?url=" + theUrl, true);
        xmlhttp.send(); 
    }
}

summarize.init();