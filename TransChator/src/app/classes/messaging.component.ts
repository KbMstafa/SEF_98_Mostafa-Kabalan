import { Injectable } from "@angular/core";
import * as firebase from 'firebase/app';

@Injectable()
export class MessagingComponent {
    public messageList;
    public messageForm;
    public messageInput;
    public submitButton;
    public messagesRef;

    constructor() {
    }

    setFormValues() {
        this.messageForm = document.getElementById('message-form');
        this.messageList = document.getElementById('messages');
        this.messageInput = document.getElementById('message');
        this.submitButton = document.getElementById('submit');
        this.messagesRef = firebase.database().ref('messages');
    }

    toggleButton() {
        if (this.messageInput.value) {
            this.submitButton.removeAttribute('disabled');
        } else {
            this.submitButton.setAttribute('disabled', 'true');
        }
    }


    saveMessage(auth) {
        if (this.messageInput.value) {
            var currentUser = auth;
            this.messagesRef.push({
                name: currentUser.displayName,
                text: this.messageInput.value,
                photoUrl: currentUser.photoURL || '/images/profile_placeholder.png'
            }).then(this.resetForm());
        }
    }

    resetForm() {
        this.messageInput.value = '';
        this.toggleButton();
    }

    loadMessages() {
        this.messagesRef.off();
        this.messagesRef.on('child_added', this.setMessage.bind(this));
        this.messagesRef.on('child_changed', this.setMessage.bind(this));
    }

    setMessage(data) {
        var val = data.val();
        this.displayMessage(data.key, val.name, val.text);
    }


    displayMessage(key, name, text) {
        var div = document.getElementById(key);
        if (!div) {
            var container = document.createElement('div');
            container.innerHTML = '<div class="message-container">'
                                + '<div class="spacing"><div class="pic"></div></div>'
                                + '<div class="message"></div>'
                                + '<div class="name"></div>'
                                + '</div>';
            div = <HTMLDivElement>container.firstChild;
            div.setAttribute('id', key);
            this.messageList.appendChild(div);
        }
        div.querySelector('.name').textContent = name;
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
