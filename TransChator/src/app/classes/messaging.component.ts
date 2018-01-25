import { Injectable } from "@angular/core";
import * as firebase from 'firebase/app';

@Injectable()
export class MessagingComponent {
    public messageList;
    public messageForm;
    public messageInput;
    public submitButton;
    public messagesRef;
    private user;
    private secondParty;
    private httpClient;
    private TimeOption = {
        hour: "2-digit", minute: "2-digit"
    };

    setFormValues(user, httpClient) {
        this.httpClient = httpClient;
        this.messageForm = document.getElementById('message-form');
        this.messageList = document.getElementById('messages');
        this.messageInput = document.getElementById('message');
        this.user = user;
        this.messageForm.addEventListener('submit', this.saveMessage.bind(this));
        this.messageInput.setAttribute('disabled', 'true');
    }

    setSecondParty(secondParty) {
        this.messageInput.removeAttribute('disabled');
        this.secondParty = secondParty;
        this.messageList.innerHTML = '';
        if (this.user.id < this.secondParty.id) {
            var conversation = this.user.id + '/' + this.secondParty.id
        } else if (this.user.id > this.secondParty.id) {
            var conversation = this.secondParty.id + '/' + this.user.id
        }
        this.messagesRef = firebase.database().ref('messages/' + conversation);
    }

    translate() {
        let promise = new Promise((resolve) => {
            this.httpClient.post('https://translation.googleapis.com/language/translate/v2?key=AIzaSyCwrEvnylWmBa-mj2TbCNwnZpEav5IbVis',
                {
                    'q': this.messageInput.value,
                    'target': this.secondParty.info.language
                })
                .subscribe(
                (res: any) => {
                    const domParserHtmlEntities = new DOMParser();
                    this.messageInput.value = domParserHtmlEntities.parseFromString(
                        res.data.translations[0].translatedText, 
                        'text/html'
                    ).body.textContent;
                    resolve();
                });
        });
        return promise;
    }

    toggleButton() {        
        if (this.messageInput.value) {
            this.submitButton.removeAttribute('disabled');
        } else {
            this.submitButton.setAttribute('disabled', 'true');
        }
    }

    saveMessage() {
        if (this.messageInput.value) {
            var unchanged = this.messageInput.value.match(/<([\w*\s*]+)>/g);
            this.messageInput.value = this.messageInput.value.replace(/(<[\w*\s*]+>)/g, "...");
            this.translate().then(() => {
                if(unchanged) {
                    for (let value of unchanged) {
                        value = value.replace('<', "`");
                        value = value.replace('>', "`");
                        this.messageInput.value = this.messageInput.value.replace("...", value);                      
                    }
                }
                this.storeMessage();
            });
        }
    }

    storeMessage() {
        this.messagesRef.push({
            name: this.user.info.name,
            text: this.messageInput.value,
            photoUrl: this.user.info.Photo_URL || '/images/profile_placeholder.png',
            time: new Date().toLocaleTimeString("en", this.TimeOption)
        }).then(this.resetForm());
        var time = new Date().getTime();
        firebase.database().ref('conversations/' + this.user.id + '/' + this.secondParty.id).set({
            time: time
        });
        firebase.database().ref('conversations/' + this.secondParty.id + '/' + this.user.id).set({
            time: time
        });
    }

    resetForm() {
        this.messageInput.value = '';
    }

    loadMessages() {
        this.messagesRef.off();
        this.messagesRef.on('child_added', this.setMessage.bind(this));
    }

    setMessage(data) {
        var val = data.val();
        this.displayMessage(data.key, val.name, val.text, val.time);
    }


    displayMessage(key, name, text, time) {
        var div = document.getElementById(key);
        if (!div) {
            var container = document.createElement('div');
            container.innerHTML = '<div class="message-container">'
                                + '<div class="message"></div>'
                                + '<div class="time"></div>'
                                + '</div>';
            div = <HTMLDivElement>container.firstChild;
            div.setAttribute('id', key);
            if(name == this.user.info.name) {
                div.classList.add('sender');
            } else {
                div.classList.add('receiver');
            }
            this.messageList.appendChild(div);
        }
        div.querySelector('.time').textContent = time;
        var messageElement = div.querySelector('.message');
        if (text) { 
            messageElement.textContent = text;
            messageElement.innerHTML = messageElement.innerHTML.replace(/\n/g, '<br>');
        }

        setTimeout(function() {
            div.classList.add('visible')
        }, 1);
        this.messageList.scrollTop = this.messageList.scrollHeight;
        this.messageInput.focus();
    }
}