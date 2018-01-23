import { Component, OnInit, HostBinding } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import * as firebase from 'firebase/app';

import { FormControl, Validators } from '@angular/forms';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']

})
export class LoginComponent implements OnInit {

    error: any;
    email = new FormControl('', [Validators.required , Validators.email]);
    password = new FormControl('', [Validators.required, Validators.minLength(6)]);
    hide = true;

    constructor(public af: AngularFireAuth, private router: Router) {

        this.af.authState.subscribe(auth => {
            if (auth) {
                this.router.navigateByUrl('/secondparty');
            }
            var signOutButton = document.getElementById('sign-out');
            var userPic = document.getElementById('user-pic');
            var userName = document.getElementById('user-name');
            signOutButton.setAttribute('hidden', 'true');
            userPic.setAttribute('hidden', 'true');
            userName.setAttribute('hidden', 'true');
        });
        

    }

    onSubmit() {
        if (this.email.valid && this.password.valid) {
            firebase.auth().signInWithEmailAndPassword(
                this.email.value, 
                this.password.value
            )
            .then(function () {
                this.router.navigate(['/secondparty']);
            })
            .catch((err) => {
                this.error = err;
            });
        }
    }

    getEmailErrorMessage() {
        return this.email.hasError('required') ? 'You must enter a email' :
            this.email.hasError('email') ? 'Not a valid email' :
                '';
    }

    getPasswordErrorMessage() {
        return this.email.hasError('required') ? 'You must enter a password' :
            this.password.hasError('minlength') ? 'Password must be at least 6 character' :
                '';
    }

    ngOnInit() {
    }

}
