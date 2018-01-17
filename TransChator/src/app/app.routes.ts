import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { AuthGuard } from './auth.service';
import { ChatScreenComponent } from './chat-screen/chat-screen.component';

export const router: Routes = [
    { path: '', redirectTo: 'login', pathMatch: 'full' },
    { path: 'login', component: LoginComponent },
    { path: 'chat', component: ChatScreenComponent, canActivate: [AuthGuard] },
    { path: 'signup', component: SignUpComponent },

]

export const routes: ModuleWithProviders = RouterModule.forRoot(router);