import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import { moveIn, fallIn } from '../router.animations';
import * as firebase from 'firebase/app';

@Component({
    selector: 'app-signup',
    templateUrl: './signup.component.html',
    styleUrls: ['./signup.component.css'],
    animations: [moveIn(), fallIn()],
    host: { '[@moveIn]': '' }
})
export class SignupComponent implements OnInit {

    state: string = '';
    error: any;

    constructor(public af: AngularFireAuth, private router: Router) {

    }

    onSubmit(formData) {
        if (formData.valid) {
            var email = formData.value.email;
            var password = formData.value.password;
            firebase.auth().createUserWithEmailAndPassword(
                email, password
                ).then(
                (success) => {
                    this.router.navigate(['/members'])
                }).catch((err) => {
                this.error = err;
            });
        }
    }

  ngOnInit() {
  }

}
