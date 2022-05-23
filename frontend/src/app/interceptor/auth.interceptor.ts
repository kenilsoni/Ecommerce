
import { HttpErrorResponse, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest } from '@angular/common/http';
import { Injectable, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { BehaviorSubject, catchError, filter, finalize, Observable, switchMap, take, throwError } from 'rxjs';
import { UserService } from '../service/user.service';


@Injectable({
  providedIn: 'root'
})
export class AuthInterceptor implements HttpInterceptor {
  private isRefreshing = false;
  private refreshTokenSubject: BehaviorSubject<any> = new BehaviorSubject<any>(null);
  constructor(private userservice:UserService, private router:Router) { }

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    this.userservice.isLoading.next(true);

    let access_token = this.userservice.getAccessToken();
    let new_req = req;
    
    if(access_token!=null){
      new_req = this.addToken(req, access_token);
    }
    
    return next.handle(new_req).pipe(catchError(error => {
      if (error instanceof HttpErrorResponse){ 
        if(error.status === 401) {
          return this.check401Error(new_req, next);
        }else if(error.status === 403){
          return this.check403Error(new_req, next);
        }
      }
      return throwError(error);
    }),
       finalize(
        () => {
          this.userservice.isLoading.next(false);
        }
      )
    
    );
  }
  addToken(req:HttpRequest<any>, token:string){
    return req.clone({
      setHeaders: {
        access_token : token
      }
    });
  }
  check401Error(req:HttpRequest<any>, next:HttpHandler){
    if(!this.isRefreshing){
      this.isRefreshing = true;
      this.refreshTokenSubject.next(null);
      let refresh = this.userservice.get_refreshtoken();
      if(refresh!=null){
        return this.userservice.refresh_token().pipe(switchMap((jwtToken:any)=>{
          this.isRefreshing = false;
          this.refreshTokenSubject.next(jwtToken);
          return next.handle(this.addToken(req, jwtToken));
        }),
        catchError((err)=>{
          if(err instanceof HttpErrorResponse && err.status===403){
            return this.check403Error(req, next);
          }
          return throwError(err);
        }));
      }
    }
    return this.refreshTokenSubject.pipe(
      filter(token => token !==null),
      take(1),
      switchMap((jwtToken:any)=>next.handle(this.addToken(req, jwtToken)))
    );
  }

  check403Error(req:HttpRequest<any>, next:HttpHandler){
    this.isRefreshing = false;
    this.userservice.unset_user();
    window.location.reload();
    return next.handle(req.clone({headers: req.headers.delete('access_token')}));
  }

 
}