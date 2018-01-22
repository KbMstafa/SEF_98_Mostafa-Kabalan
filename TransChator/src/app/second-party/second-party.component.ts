import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import { MessagingComponent } from '../classes/messaging.component';
import { HttpClient } from '@angular/common/http';
import { DataService } from "../data.service";

import * as firebase from 'firebase/app';

@Component({
    selector: 'app-second-party',
    templateUrl: './second-party.component.html',
    styleUrls: ['./second-party.component.css']
})
export class SecondPartyComponent implements OnInit {
    user: any;
    secondParty: any;
    conversations = [];

    constructor(
        public af: AngularFireAuth,
        private router: Router,
        private data: DataService
    ) {
        var that = this;
        that.af.authState.subscribe(auth => {
            if (auth) {
                firebase.database().ref('users/' + auth.uid)
                .on('value', (snapshot) => {
                    that.user = {
                        id: auth.uid,
                        info: snapshot.val()
                    };
                    var signOutButton = document.getElementById('sign-out');
                    var userPic = document.getElementById('user-pic');
                    var userName = document.getElementById('user-name');

                    var profilePicUrl = that.user.info.photoURL;
                    var usrName = that.user.info.name;
                    userPic.style.background = 'url(assets/images/profile_placeholder.png)';
                    userPic.style.backgroundSize = 'contain';
                    userName.textContent = usrName;

                    userName.removeAttribute('hidden');
                    userPic.removeAttribute('hidden');
                    signOutButton.removeAttribute('hidden');


                    var emailSearch = document.getElementById('email-search');
                    var search = <HTMLInputElement>document.getElementById('search');
                    emailSearch.addEventListener('submit', () => {
                        that.loadSecondParty(search.value);
                    }); 

                    that.loadSecondPartiesConversations();
                });
            }
        });
    }

    ngOnInit() {
    }

    loadSecondParty(email) {
        var that = this;
        firebase.database().ref('users/')
            .orderByChild("email")
            .equalTo(email)
            .on("value", (snapshot) => {
                if (!snapshot.val()) {
                    that.secondParty = null;
                } else {
                    for (var userUid in snapshot.val()) {
                        that.secondParty = {
                            id: userUid,
                            info: snapshot.val()[userUid]
                        };
                    }
                }
                that.data.changeMessage(that.secondParty);
                that.router.navigate(['/chat']);
            });
    }

    loadSecondPartiesConversations() {
        var that = this;
        firebase.database()
        .ref('conversations/' + that.user.id)
        .orderByChild("time")
        .on("value", (snapshot) => {
            snapshot.forEach((item) => {
                var conversation = {
                    name: '',
                    email: '',
                    message: ''
                };
                firebase.database()
                .ref('users/' + item.key)
                .on('value', (snapshot) => {
                    conversation.name = snapshot.val().name;
                    conversation.email = snapshot.val().email;
                    if (that.user.id < item.key) {
                        var conversationRef = that.user.id + '/' + item.key
                    } else if (that.user.id > item.key) {
                        var conversationRef = item.key + '/' + that.user.id
                    }
                    firebase.database()
                    .ref('messages/' + conversationRef)
                    .limitToLast(1)
                    .on('value', (snapshot) => {
                        snapshot.forEach((item) => {
                            conversation.message = item.val().text;
                            that.conversations.unshift(conversation);
                            return false;
                        });
                    });
                });
                return false;
            });
        });
    }
    
    select(element) {
        console.log(element);
    }
}