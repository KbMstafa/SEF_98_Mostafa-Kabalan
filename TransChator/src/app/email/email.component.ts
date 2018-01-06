import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import { moveIn, fallIn } from '../router.animations';
import * as firebase from 'firebase/app';

@Component({
    selector: 'app-email',
    templateUrl: './email.component.html',
    styleUrls: ['./email.component.css'],
    animations: [moveIn(), fallIn()],
    host: { '[@moveIn]': '' }
})
export class EmailComponent implements OnInit {

    state: string = '';
    error: any;

    constructor(public af: AngularFireAuth, private router: Router) {
        this.af.authState.subscribe(auth => {
            if (auth) {
                this.router.navigateByUrl('/members');
            }
        });
    }


    onSubmit(formData) {
        if (formData.valid) {
            var email = formData.value.email;
            var password = formData.value.password;
            firebase.auth().signInWithEmailAndPassword(
                email, password
            ).then((success) => {
                this.router.navigate(['/members']);
            }).catch((err) => {
                this.error = err;
            });
        }
    }

    ngOnInit() {
    }

}
