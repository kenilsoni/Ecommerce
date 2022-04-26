import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private httpclient:HttpClient) { }
  save_user(data:any){
    return this.httpclient.post<any>(`${environment.API_URL}/user/create.php`,data)
  }
  check_username(data:string){
    return this.httpclient.get<any>(`${environment.API_URL}/user/check.php?username=`+data)

  }
  check_email(data:string){
    return this.httpclient.get<any>(`${environment.API_URL}/user/check.php?email=`+data)

  }
  check_login(username:string,password:string){
    return this.httpclient.get<any>(`${environment.API_URL}/user/login.php?username=`+username+`&password=`+password)

  }
  set_user(data:string){
    localStorage.setItem('data',data)

  }
  unset_user(data:string){
    localStorage.removeItem('data')

  }
  get_user(){
    return localStorage.getItem('data')
  }

}
