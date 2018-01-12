import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { AngularFireModule } from 'angularfire2';
import { AngularFireDatabaseModule } from 'angularfire2/database';
import { AngularFireAuthModule } from 'angularfire2/auth';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { AppComponent } from './app.component';
import { environment } from '../environments/environment';
import { LoginComponent } from './login/login.component';
import { AuthGuard } from './auth.service';
import { routes } from './app.routes';
import { HeaderComponent } from './header/header.component';
import { ChatScreenComponent } from './chat-screen/chat-screen.component';
import { MessagingComponent } from './classes/messaging.component';


@NgModule({
    declarations: [
        AppComponent,
        LoginComponent,
        HeaderComponent,
        ChatScreenComponent
    ],
    imports: [
        BrowserModule,
        BrowserAnimationsModule,
        FormsModule,
        AngularFireModule.initializeApp(environment.firebase),
        AngularFireDatabaseModule,
        AngularFireAuthModule,
        NgbModule.forRoot(),
        routes
    ],
    providers: [AuthGuard, MessagingComponent],
    bootstrap: [AppComponent]
})
export class AppModule { }
