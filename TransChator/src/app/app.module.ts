import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { HttpsRequestInterceptor } from './interceptor.module';
import { AsyncLocalStorageModule } from 'angular-async-local-storage';

import { AngularFireModule } from 'angularfire2';
import { AngularFireDatabaseModule } from 'angularfire2/database';
import { AngularFireAuthModule } from 'angularfire2/auth';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { AppComponent } from './app.component';
import { environment } from '../environments/environment';
import { LoginComponent } from './login/login.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { AuthGuard } from './auth.service';
import { routes } from './app.routes';
import { HeaderComponent } from './header/header.component';
import { ChatScreenComponent } from './chat-screen/chat-screen.component';
import { MessagingComponent } from './classes/messaging.component';
import { SecondPartyComponent } from "./second-party/second-party.component";
import { DataService } from './data.service';


@NgModule({
    declarations: [
        AppComponent,
        LoginComponent,
        SignUpComponent,
        HeaderComponent,
        ChatScreenComponent,
        SecondPartyComponent
    ],
    imports: [
        BrowserModule,
        FormsModule,
        AngularFireModule.initializeApp(environment.firebase),
        AngularFireDatabaseModule,
        AngularFireAuthModule,
        NgbModule.forRoot(),
        routes,
        HttpClientModule,
        AsyncLocalStorageModule
    ],
    providers: [
        AuthGuard, 
        MessagingComponent,
        DataService,
        {
            provide: HTTP_INTERCEPTORS,
            useClass: HttpsRequestInterceptor,
            multi: true
        }
    ],
    bootstrap: [AppComponent]
})
export class AppModule { }
