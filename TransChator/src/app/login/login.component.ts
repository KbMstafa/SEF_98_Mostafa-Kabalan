import { Component, OnInit, HostBinding } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import { moveIn } from '../router.animations';
import * as firebase from 'firebase/app';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css'],
    animations: [moveIn()]

})
export class LoginComponent implements OnInit {

    error: any;
    constructor(public af: AngularFireAuth, private router: Router) {

        this.af.authState.subscribe(auth => {
            if (auth) {
                this.router.navigateByUrl('/chat');
            }
            var signOutButton = document.getElementById('sign-out');
            var userPic = document.getElementById('user-pic');
            var userName = document.getElementById('user-name');
            signOutButton.setAttribute('hidden', 'true');
            userPic.setAttribute('hidden', 'true');
            userName.setAttribute('hidden', 'true');

        });

    }

    loginFb() {
        var provider = new firebase.auth.FacebookAuthProvider();
        firebase.auth().signInWithPopup(
            provider
        ).then(function(result) {
            var user = result.user;
            addToDatabase(user);
            this.router.navigate(['/chat']);
        }).catch((err) => {
            this.error = err;
        });
    }

    loginGoogle() {
        var provider = new firebase.auth.GoogleAuthProvider();
        firebase.auth().signInWithPopup(
            provider
        ).then(function(result) {
            var user = result.user;
            addToDatabase(user);
            this.router.navigate(['/chat']);
        }).catch((err) => {
            this.error = err;
        });
    }

    
        
        
        
        

    ngOnInit() {
    }

}

function addToDatabase(user) {
    firebase.database().ref('users/' + user.uid).set({
        Name: user.displayName,
        Photo_URL: user.photoURL,
        email: user.email,
        Phone_Number: user.phoneNumber
    }).catch(function(error) {
        console.log('Error :', error);
    });
}