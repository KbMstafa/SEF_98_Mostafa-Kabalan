import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import { moveIn, fallIn, moveInLeft } from '../router.animations';
import * as firebase from 'firebase/app';

@Component({
    selector: 'app-members',
    templateUrl: './members.component.html',
    styleUrls: ['./members.component.css'],
    animations: [moveIn(), fallIn(), moveInLeft()],
    host: { '[@moveIn]': '' }
})
export class MembersComponent implements OnInit {

    error: any; 
    name: any;
    state: string = '';

    constructor(public af: AngularFireAuth, private router: Router) {

        this.af.authState.subscribe(auth => {
            if (auth) {
                this.name = auth;
            }
        });

    }

    logout() {
        firebase.auth().signOut().then(function () {
            // Sign-out successful.
        }).catch(
        (err) => {
            this.error = err;
        });
        this.router.navigateByUrl('/login');
    }

    ngOnInit() {
    }

}
