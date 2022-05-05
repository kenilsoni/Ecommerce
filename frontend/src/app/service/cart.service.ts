import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  localsetItem:any=[]
  total!:any
  public cartItemList : any =[]
  public productList = new BehaviorSubject<any>([]);
  public search = new BehaviorSubject<string>("");
  // public grand_total = new BehaviorSubject<any>([]);
  constructor(private httpclient:HttpClient) { 
    if(this.get_cart().length>0){
      // console.log(this.get_cart())
      // this.cartItemList.push(this.get_cart())
      // this.total=this.get_total()
      this.productList.next(this.get_cart());
    }

  //  console.log(this.cartItemList)
    // this.cartItemList=this.get_cart()
    // this.total=this.get_total()
    
  }
  getProducts(){
    return this.productList.asObservable();
  }
  setProduct(product : any){
    this.cartItemList.push(...product)
    this.productList.next(product);
  }
  addtoCart(product : any){
    this.cartItemList.map((a:any, index:any)=>{
      if(a.ID=== product.ID){
        console.log(a.ID)
      }
    })
    this.cartItemList.push(product);
    this.productList.next(this.cartItemList);
    this.getTotalPrice();
    this.set_cart()
    console.log(this.cartItemList)
  }
  update_product(product : any){
    this.cartItemList.map((a:any, index:any)=>{
      if(a.ID=== product.ID){
        this.cartItemList.splice(index,1);
        this.cartItemList.push(product)
        this.productList.next(this.cartItemList);
        // console.log(total)
      }
    })
  }
  getTotalPrice() : number{
    let grandTotal = 0;
    this.cartItemList.map((a:any)=>{
      grandTotal += Number(a.Product_Price*a.Product_Quantity);
    })
    return grandTotal;
  }
  removeCartItem(product: any){
    this.cartItemList.map((a:any, index:any)=>{
      if(product.ID=== a.ID){
        this.cartItemList.splice(index,1);
      }
    })
    this.productList.next(this.cartItemList);
    this.set_cart()
  }
  removeAllCart(){
    this.cartItemList = []
    this.productList.next(this.cartItemList);
    this.set_cart()
  }
  set_cart(){
        localStorage.setItem("cart_data",JSON.stringify(this.cartItemList));
        localStorage.setItem("cart_total",JSON.stringify(this.getTotalPrice()));
  }
  get_cart(){
    if(localStorage.getItem("cart_data") !== null){
      this.localsetItem=localStorage.getItem("cart_data")
      return JSON.parse(this.localsetItem)
    }else{
      return false
    }
  }
  get_total(){
    if(localStorage.getItem("cart_total") !== null){
      this.total=localStorage.getItem("cart_total")
      return JSON.parse(this.total)
    }else{
      return false
    }
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