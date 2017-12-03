var newId = 1;

var options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour:'numeric',
            minute:'numeric'
        };
var dateTimeFormat = new Intl.DateTimeFormat('en-US',options);

var Note = {
    title: "",
    date: "",
    description: "",
    display: function(id) {
        var div = document.createElement('div');
        div.id = id;
        div.className = 'do';
        div.innerHTML = '<div class="note">\
                             <h1>' + this.title + '</h1>\
                             <h4>added: ' + this.date + '</h4>\
                             <h2>\
                                 <textarea id="desc" cols="24" disabled="true">'
                                  + this.description + 
                                '</textarea>\
                             </h2>\
                         </div>\
                         \
                         <div class="clear">\
                             <input type="button" value="X" onclick="removeNote(this)">\
                         </div>';
        document.getElementById('list').insertAdjacentElement('afterbegin', div);
    },
    store: function(id) {
        var Notes = JSON.parse(localStorage.getItem("Note"));
        if (Notes == null) {
            Notes = [];
        }
        Notes = Notes.concat([id]);
        localStorage.setItem("Note", JSON.stringify(Notes));
        localStorage.setItem(id, JSON.stringify(this));
    }
};

var addButton = document.getElementById("add");
addButton.addEventListener("click", addNote);

var body = document.getElementById("body");
body.addEventListener("load", load());

if (typeof Object.create != 'function') {
    Object.create = function(o) {
        var F = function() {};
        F.prototype = o;
        return new F();
    }
}

function load() {
    var Notes = JSON.parse(localStorage.getItem("Note"));
    if (Notes != null) {
        var len = Notes.length;
        for (var i = 0; i < len; i++) {
            var obj = JSON.parse(localStorage.getItem(Notes[i]));
            obj.__proto__ = Note;
            obj.display(Notes[i]);
        }
        newId = Notes[len - 1] + 1;
    }
}

function removeNote(input) {
    var div = input.parentNode.parentNode;
    document.getElementById('list').removeChild( div );
    localStorage.removeItem(div.id);

    var Notes = JSON.parse(localStorage.getItem("Note"));
    NoteIndex = Notes.indexOf(parseInt(div.id));
    Notes.splice(NoteIndex, 1);
    localStorage.setItem("Note", JSON.stringify(Notes));
}

function addNote() {
    var title = document.getElementById('title').value;
    var description = document.getElementById('description').value;
    if(title == "" || description == "") {
        if(title == "") {
            resetCursor(document.getElementById('title'))
        } else {
            resetCursor(document.getElementById('description'))
        }
    } else {
        if (isNaN(newId)) {
            newId = 1;  
        }

        document.getElementById('title').value="";
        document.getElementById('description').value="";

        var newNote = Object.create(Note);
        newNote.title = title;
        newNote.date = dateTimeFormat.format(new Date());
        newNote.description = description;
        newNote.store(newId);
        newNote.display(newId);

        var id = newId.toString();
        newId++;
    }
}

function displayNote(id, inHTML) {
    var div = document.createElement('div');
    div.id = id;
    div.className = 'do';
    div.innerHTML = inHTML;
    document.getElementById('list').insertAdjacentElement('afterbegin', div);
}
