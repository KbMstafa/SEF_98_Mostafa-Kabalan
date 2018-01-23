import { Injectable } from "@angular/core";
import { AsyncLocalStorage } from 'angular-async-local-storage';

@Injectable()
export class DataService {

    constructor(public localStorage: AsyncLocalStorage) { }

    changeMessage(secondParty: Object){
        let promise = new Promise((resolve) => {
            this.localStorage.removeItem('secondParty').subscribe(() => {
                this.localStorage.setItem('secondParty', secondParty).subscribe(() => {
                    resolve();
                });
            });
        });
        return promise;
    }
}