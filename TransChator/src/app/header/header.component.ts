import { Component, OnInit } from '@angular/core';
import { AngularFireModule } from 'angularfire2';
import { AngularFireAuthModule, AngularFireAuth } from 'angularfire2/auth';
import { Router } from '@angular/router';
import { moveIn, fallIn, moveInLeft } from '../router.animations';
import * as firebase from 'firebase/app';

@Component({
    selector: 'app-header',
    templateUrl: './header.component.html',
    styleUrls: ['./header.component.css'],
    animations: [moveIn(), fallIn(), moveInLeft()]

})
export class HeaderComponent implements OnInit {

    error: any;
    state: string = '';

    constructor(private router: Router, ) {
    }

    logout() {
        firebase.auth().signOut().then((success) => {
            this.router.navigate(['/login']);
        }).catch(
            (err) => {
                this.error = err;
            }
        );
    }

    ngOnInit() {
    }

}
