import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import { moveIn, fallIn, moveInLeft } from '../router.animations';
import { MessagingComponent } from '../classes/messaging.component';
import { HttpClient } from '@angular/common/http';

import * as firebase from 'firebase/app';

@Component({
    selector: 'app-chat-screen',
    templateUrl: './chat-screen.component.html',
    styleUrls: ['./chat-screen.component.css'],
    animations: [moveIn(), fallIn(), moveInLeft()]
})

export class ChatScreenComponent implements OnInit {

    error: any;
    user: any;
    state: string = '';
    secondParty: any;

    constructor(
        public af: AngularFireAuth, 
        private router: Router, 
        public messaging: MessagingComponent,
        private httpClient:HttpClient
        ) {
        var that = this;
        that.af.authState.subscribe(auth => {
            if (auth) {

                firebase.database().ref('users/' + auth.uid).on('value', (snapshot) => {
                    that.user = {
                        id: auth.uid,
                        info: snapshot.val()
                    };

                    var signOutButton = document.getElementById('sign-out');
                    var userPic = document.getElementById('user-pic');
                    var userName = document.getElementById('user-name');

                    var profilePicUrl = that.user.info.photoURL;
                    var usrName = that.user.info.name;
                    var httpClient = that.httpClient;

                    userPic.style.background = 'url(assets/images/profile_placeholder.png)';
                    userPic.style.backgroundSize = 'contain';
                    userName.textContent = usrName;

                    userName.removeAttribute('hidden');
                    userPic.removeAttribute('hidden');
                    signOutButton.removeAttribute('hidden');

                    var emailSearch = document.getElementById('email-search');
                    var search = <HTMLInputElement>document.getElementById('search');

                    that.messaging.setFormValues(that.user, httpClient);                    
                    
                    emailSearch.addEventListener('submit', function() {
                        firebase.database().ref('users/')
                        .orderByChild("email")
                        .equalTo(search.value)
                        .on("value", (snapshot) => {
                            if(!snapshot.val()) {
                                that.messaging.messageList.innerHTML = '<h4> The username you have provided isn\'t currently registered in our system. </h4>';
                                that.messaging.messageInput.value = '';
                                that.messaging.messageInput.setAttribute('disabled', 'true');
                            } else {
                                for(var userUid in snapshot.val()) {
                                    that.secondParty = {
                                        id: userUid,
                                        info: snapshot.val()[userUid]
                                    };
                                }
                                that.messaging.setSecondParty(that.secondParty);
                            
                                that.messaging.loadMessages();
                                
                                that.messaging.messageInput.addEventListener('keyup', function () {
                                    messaging.toggleButton()
                                });
                                that.messaging.messageInput.addEventListener('change', function () {
                                    messaging.toggleButton()
                                });
                            }
                        });
                    });

                    /* that.messaging.messageForm.addEventListener('submit', function () {
                        messaging.saveMessage()
                    });
                    that.messaging.messageInput.addEventListener('keyup', function () {
                        messaging.toggleButton()
                    });
                    that.messaging.messageInput.addEventListener('change', function () {
                        messaging.toggleButton()
                    }); */
                });
            }
        });
    }

    ngOnInit() {
    }
}