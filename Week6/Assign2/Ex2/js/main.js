//localStorage.setItem('bgcolor', 'red');

var newId = parseInt(localStorage.key(localStorage.length - 1)) + 1;
//alert(newId);


function load() {
    for ( var len = localStorage.length, i = 0; i < len; i++ ) {
        var obj = localStorage.getItem( localStorage.key( i ) );
        var div = document.createElement('div');

        div.id = localStorage.key( i );
        div.className = 'do';

        div.innerHTML = obj;
        document.getElementById('list').insertAdjacentElement('afterbegin', div);
    }
}

function removeNote(input) {
    //alert(input.parentNode.parentNode.id);
    document.getElementById('list').removeChild( input.parentNode.parentNode );
    localStorage.removeItem(input.parentNode.parentNode.id);
}

function addNote() {
    var title = document.getElementById('title').value;
    var description = document.getElementById('description').value;
    if(title == "" || description == "") {
        if(title == "") {
            alert("title is empty");
        } else {
            alert("description is empty");
        }
    } else {
        var div = document.createElement('div');
        document.getElementById('title').value="";
        document.getElementById('description').value="";
        
        if (isNaN(newId)) {
            newId = 1;
        }

        div.id = newId.toString();
        newId++;
        div.className = 'do';

        div.innerHTML = '<div class="note"> <h1>' + title + '</h1>\
            <h3>added: ' + Date() + '</h3>\
            <h2>' + description + '</h2></div>\
            <div class="clear"> <input type="button" value="X" onclick="removeNote(this)"></div>';
        document.getElementById('list').insertAdjacentElement('afterbegin', div);
        localStorage.setItem(div.id, div.innerHTML);
    }
}

