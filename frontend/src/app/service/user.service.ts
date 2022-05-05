import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import {  Router } from '@angular/router';
import { BehaviorSubject, map, Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
@Injectable({
  providedIn: 'root'
})
export class UserService {

  user_detail: any
  refresh_token_time:any;
  constructor(private httpclient: HttpClient,private router:Router) { }
  save_user(data: any) {
    return this.httpclient.post<any>(`${environment.API_URL}/user/create.php`, data)
  }
  update_user(data: any) {
    return this.httpclient.post<any>(`${environment.API_URL}/user/update.php`, data)
  }
  check_username(data: string) {
    return this.httpclient.get<any>(`${environment.API_URL}/user/check.php?username=` + data)
  }
  check_email(data: string) {
    return this.httpclient.get<any>(`${environment.API_URL}/user/check.php?email=` + data)
  }
  check_login(username: string, password: string) {
    return this.httpclient.get<any>(`${environment.API_URL}/user/login.php?username=` + username + `&password=` + password)
      .pipe(map(response => {
        if (response['success']) {
          this.set_user(response)
          this.check_refresh_token()
        }
        return response;
      }));
  }
  getAccessToken() {
    let data = this.get_user()
    if (data != null) {
      return data.access_token;
    } else {
      return null;
    }
  }
  set_user(response: any) {
    localStorage.setItem('loggedInUser', JSON.stringify(response));
  }
  unset_user() {
    localStorage.removeItem('loggedInUser')
    this.stop_refreshToken()
    this.router.navigate(['/home']);
  }
  get_user() {
    if (localStorage.getItem('loggedInUser') !== null) {
      this.user_detail = localStorage.getItem('loggedInUser')
      return JSON.parse(this.user_detail)
    } else {
      return false
    }
  }
  check_refresh_token(){
    let token = this.get_user();
    if(token!==null){
      let exp_time = token.expiry;
      let curr_time = Math.ceil(Date.now()/1000)
      let time = exp_time - curr_time;
      this.refresh_token_time = setTimeout(()=>{
        this.refresh_token().subscribe();
        this.stop_refreshToken();
      }, (time)*1000);
    }
  }
  stop_refreshToken(){
    clearTimeout(this.refresh_token_time);
  }
  refresh_token() {
    let refreshtoken = this.get_refreshtoken();
    let header = {'Content-Type': 'application/json'};
    return this.httpclient.post<any>(`${environment.API_URL}/user/refresh_token.php`, {'refreshToken': refreshtoken},{ headers : header}).
      pipe(map((res: any) => {
        this.set_accesstoken(res["result"]);
        this.set_tokenexpiry(res["expiry"]);
        this.check_refresh_token();
        return res["result"];
      }));
  }
  get_refreshtoken() {
    let data = this.get_user()
    if (data != null) {
      return data.refresh_token;
    } else {
      return null;
    }
  }
  set_tokenexpiry(time:any){
    let data =this.get_user()
    if (data != null) {
      data.expiry = time;
      localStorage.setItem("loggedInUser", JSON.stringify(data));
    }
  }
  set_accesstoken(token: any) {
    let data = this.get_user()
    if (data != null) {
      data.access_token = token;
      localStorage.setItem("loggedInUser", JSON.stringify(data));
    }
  }
  get_userdetails(id:number){
    return this.httpclient.get<any>(`${environment.API_URL}/user/getuser.php?ID=`+id)
  }
  get_state(id:number){
    return this.httpclient.get<any>(`${environment.API_URL}/state/read.php?id=`+id)
  }
  get_country(){
    return this.httpclient.get<any>(`${environment.API_URL}/country/read.php`)
  }
  get_city(id:number){
    return this.httpclient.get<any>(`${environment.API_URL}/city/read.php?id=`+id)
  }
  // change_name(name:string){
  //   let data=this.get_user()
  //   data.firstName=name
  //   window.location.reload()
  // }
}
