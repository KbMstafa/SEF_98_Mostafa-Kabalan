import { Injectable } from "@angular/core";
import { BehaviorSubject } from "rxjs/BehaviorSubject";

@Injectable()
export class DataService {

    private messageSource = new BehaviorSubject<Object>(null);
    currentMessage = this.messageSource.asObservable();

    constructor() {}

    changeMessage(message: Object){
        this.messageSource.next(message);
    }
}