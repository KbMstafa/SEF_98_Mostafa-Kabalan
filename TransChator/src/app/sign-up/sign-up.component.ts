import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import * as firebase from 'firebase/app';

import { FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent implements OnInit {

    error: any;
    languages = [];
    phone = new FormControl('');
    name = new FormControl('', [Validators.required]);
    email = new FormControl('', [Validators.required, Validators.email]);
    password = new FormControl('', [Validators.required, Validators.minLength(6)]);
    languageControl = new FormControl('', [Validators.required]);
    hide = true;

    constructor(public af: AngularFireAuth, private router: Router) {
        this.af.authState.subscribe((auth) => {
            if (auth) {
                this.router.navigate(['/secondparty']);
            }
        });
        firebase.database().ref('languages').on('value', (languages) => {
            for (var language in languages.val()) {
                this.languages.push(languages.val()[language]);

            }
        });
    }

    getNameErrorMessage() {
        return this.name.hasError('required') ? 'You must enter a name' :
                '';
    }

    getEmailErrorMessage() {
        return this.email.hasError('required') ? 'You must enter a email' :
            this.email.hasError('email') ? 'Not a valid email' :
                '';
    }

    getLanguageErrorMessage() {
        return this.languageControl.hasError('required') ? 'Please choose an language' :
                '';
    }

    getPasswordErrorMessage() {
        return this.email.hasError('required') ? 'You must enter a password' :
            this.password.hasError('minlength') ? 'Password must be at least 6 character' :
            '';
    }

    ngOnInit() {
    }

    addToDatabase(id) {
        let promise = new Promise((resolve) => {
            firebase.database().ref('users/' + id).set({
                name: this.name.value,
                email: this.email.value,
                phone_number: (this.phone.value || null),
                language: this.languageControl.value
            });
            resolve();
        });
        return promise;
    }

    onSubmit() {
        if (this.email.valid
            && this.password.valid
            && this.name.valid
            && this.languageControl.valid
        ) {
            var that = this;
            firebase.auth().createUserWithEmailAndPassword(
                this.email.value,
                this.password.value
            )
                .then((user) => {
                    user.sendEmailVerification();
                    that.addToDatabase(user.uid).then(() => {
                        that.router.navigate(['/secondparty']);
                    });
                })
                .catch((err) => {
                    that.error = err;
                });
        }
    }
}
