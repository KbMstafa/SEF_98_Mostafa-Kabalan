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

    onSubmit(formData) {
        if (formData.valid) {
            var email = formData.value.email;
            var password = formData.value.password;
            firebase.auth().signInWithEmailAndPassword(email, password)
            .then(function () {
                this.router.navigate(['/chat']);
            })
            .catch((err) => {
                this.error = err;
            });
        }
    }

    ngOnInit() {
    }

}