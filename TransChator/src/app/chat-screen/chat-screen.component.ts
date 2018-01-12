import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import { moveIn, fallIn, moveInLeft } from '../router.animations';
import { MessagingComponent } from '../classes/messaging.component';

import * as firebase from 'firebase/app';

@Component({
    selector: 'app-chat-screen',
    templateUrl: './chat-screen.component.html',
    styleUrls: ['./chat-screen.component.css'],
    animations: [moveIn(), fallIn(), moveInLeft()]
})

export class ChatScreenComponent implements OnInit {

    error: any;
    name: any;
    state: string = '';

    constructor(public af: AngularFireAuth, private router: Router, public messaging: MessagingComponent) {

        this.af.authState.subscribe(auth => {
            if (auth) {
                this.name = auth;

                var signOutButton = document.getElementById('sign-out');
                var userPic = document.getElementById('user-pic');
                var userName = document.getElementById('user-name');

                var profilePicUrl = auth.photoURL;
                var usrName = auth.displayName;

                
                userPic.style.backgroundImage = 'url(' + (profilePicUrl || '/images/profile_placeholder.png') + ')';
                userName.textContent = usrName;

                
                userName.removeAttribute('hidden');
                userPic.removeAttribute('hidden');
                signOutButton.removeAttribute('hidden'); 

                this.messaging.setFormValues();

                this.messaging.loadMessages();

                this.messaging.messageForm.addEventListener('submit', function() {
                    messaging.saveMessage(auth)
                });
                this.messaging.messageInput.addEventListener('keyup', function() {
                    messaging.toggleButton()
                });
                this.messaging.messageInput.addEventListener('change', function() {
                    messaging.toggleButton()
                });

                /*tr();*/


            }
        });
    }

    ngOnInit() {
    }

}


/*function tr() {

// Your Google Cloud Platform project ID
const projectId = 'YOUR_PROJECT_ID';

// Instantiates a client
const translate = new Translate({
  projectId: projectId,
});

// The text to translate
const text = 'Hello, world!';
// The target language
const target = 'ru';

// Translates some text into Russian
translate
  .translate(text, target)
  .then(results => {
    const translation = results[0];

    console.log(`Text: ${text}`);
    console.log(`Translation: ${translation}`);
  })
  .catch(err => {
    console.error('ERROR:', err);
  });
  console.log(firebase);
  console.log(translate);
}*/