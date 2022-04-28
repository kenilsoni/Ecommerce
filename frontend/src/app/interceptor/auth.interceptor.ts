import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { UserService } from '../service/user.service';

@Injectable()
export class AuthInterceptor implements HttpInterceptor {

  constructor(private userservice:UserService) {}

  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {
    if (this.userservice.get_user()) {
      let data=this.userservice.get_user()
      // console.log(data['token'])
      request = request.clone({
        setHeaders: {
            Authorization: `Bearer ${data['token']}`
        }
    });
    }
    return next.handle(request);
  }
}
