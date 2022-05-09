import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { UserService } from '../service/user.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  constructor(private route:Router,private userservice:UserService){}
  canActivate():  boolean{
    if(!this.userservice.get_user()){
      this.route.navigate(['/home'])
    }
    return true
    
  }
  
}
