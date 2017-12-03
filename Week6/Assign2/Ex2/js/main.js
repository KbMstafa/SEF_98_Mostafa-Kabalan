var newId = parseInt(localStorage.key(localStorage.length - 1)) + 1;

function load() {
    for ( var len = localStorage.length, i = 0; i < len; i++ ) {
        var obj = localStorage.getItem( localStorage.key( i ) );
        displayNote(localStorage.key( i ), obj);
    }
}

function removeNote(input) {
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
        document.getElementById('title').value="";
        document.getElementById('description').value="";
        if (isNaN(newId)) {
            newId = 1;
        }

        var inHTML = '<div class="note">\
                          <h1>' + title + '</h1>\
                          <h3>added: ' + Date() + '</h3>\
                          <h2><textarea cols="24" disabled="true">' + description + '</textarea></h2>\
                      </div>\
                      \
                      <div class="clear">\
                          <input type="button" value="X" onclick="removeNote(this)">\
                      </div>';
        var id = newId.toString();
        newId++;
        displayNote(id, inHTML);
        localStorage.setItem(id, inHTML);
    }
}

function displayNote(id, inHTML) {
    var div = document.createElement('div');
    div.id = id;
    div.className = 'do';
    div.innerHTML = inHTML;
    document.getElementById('list').insertAdjacentElement('afterbegin', div);
}