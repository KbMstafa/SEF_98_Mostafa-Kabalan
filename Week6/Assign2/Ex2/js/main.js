var newId = parseInt(localStorage.key(localStorage.length - 1)) + 1;

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
        localStorage.setItem(id, JSON.stringify(this));
    }
};

if (typeof Object.create != 'function') {
    Object.create = function(o) {
        var F = function() {};
        F.prototype = o;
        return new F();
    }
}

function load() {
    for ( var len = localStorage.length, i = 0; i < len; i++ ) {
        var obj = JSON.parse(localStorage.getItem( localStorage.key( i )) );
        obj.__proto__ = Note;
        obj.display(localStorage.key( i ));
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
        console.log(newNote);

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

function resetCursor(textarea) { 
        textarea.focus(); 
}

/*var textarea = document.getElementById('desc');

textarea.addEventListener('keydown', autosize);
             
function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}*/