import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import * as firebase from 'firebase/app';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent implements OnInit {

    error: any;
    languages = [];

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

    onSubmit(formData) {
        if (formData.valid) {
            var email = formData.value.email;
            var password = formData.value.password;
            var that = this;
            firebase.auth().createUserWithEmailAndPassword(email, password)
            .then((user) => {
                user.sendEmailVerification();
                that.addToDatabase(user.uid, formData).then(() => {
                    that.router.navigate(['/secondparty']);
                });
            })
            .catch((err) => {
                that.error = err;
            });
        }
    }

    ngOnInit() {
    }

    addToDatabase(id, formData) {
        let promise = new Promise((resolve) => {
            firebase.database().ref('users/' + id).set({
                name: formData.value.name,
                email: formData.value.email,
                phone_number: (formData.value.phone || null),
                language: formData.value.language
            });
            resolve();
        });
        return promise;
    }
}
