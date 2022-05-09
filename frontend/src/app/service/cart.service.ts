import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  user_detail:any
  constructor(private httpclient:HttpClient) {  
  }
  get_id() {
    if (localStorage.getItem('loggedInUser') !== null) {
      this.user_detail = localStorage.getItem('loggedInUser')
      return JSON.parse(this.user_detail)
    } else {
      return false
    }
  }
  getProducts(id:number){
    return this.httpclient.get<any>(`${environment.API_URL}/cart/cart.php?user_id=`+id)
  }
  
  setProduct(product : any){
   
  }
  addtoCart(product : any){
    return this.httpclient.post<any>(`${environment.API_URL}/cart/add.php`, product)
  }
  update_product(product : any){
    return this.httpclient.post<any>(`${environment.API_URL}/cart/update.php`, product)
  }
  getTotalPrice(){
   
  }
  removeCartItem(id: number){
    return this.httpclient.get<any>(`${environment.API_URL}/cart/remove.php?id=`+id)
  }
  removeAllCart(user_id:number){
    return this.httpclient.get<any>(`${environment.API_URL}/cart/remove.php?user_id=`+user_id)
  }
  
 
  
  get_total(){
    // if(localStorage.getItem("cart_total") !== null){
    //   this.total=localStorage.getItem("cart_total")
    //   return JSON.parse(this.total)
    // }else{
    //   return false
    // }
  }
  get_country(){
    return this.httpclient.get<any>(`${environment.API_URL}/tax/tax.php`)
  }
  get_state(id:number){
    return this.httpclient.get<any>(`${environment.API_URL}/tax/tax.php?id=`+id)
  }
  getcolorby_id(id:number){
    return this.httpclient.get<any>(`${environment.API_URL}/color/read.php?product_id=`+id)
  }
  getsizeby_id(id:number){
    return this.httpclient.get<any>(`${environment.API_URL}/size/read.php?product_id=`+id)
  }
}