import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, map, Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
@Injectable({
  providedIn: 'root'
})
export class UserService {

  user_detail: any
  constructor(private httpclient: HttpClient) { }
  save_user(data: any) {
    return this.httpclient.post<any>(`${environment.API_URL}/user/create.php`, data)
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
        }
        return response;
      }));
  }
  set_user(response: any) {
    localStorage.setItem('loggedInUser', JSON.stringify(response));
  }
  unset_user() {
    localStorage.removeItem('loggedInUser')
  }
  get_user() {
    if (localStorage.getItem('loggedInUser') !== null) {
      this.user_detail = localStorage.getItem('loggedInUser')
      return JSON.parse(this.user_detail)
    } else {
      return false
    }
  }

}
