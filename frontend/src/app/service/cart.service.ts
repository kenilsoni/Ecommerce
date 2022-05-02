import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  localsetItem!:any
  total!:any
  public cartItemList : any =[]
  public productList = new BehaviorSubject<any>([]);
  public search = new BehaviorSubject<string>("");

  constructor() {}
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
  getTotalPrice() : number{
    let grandTotal = 0;
    this.cartItemList.map((a:any)=>{
      grandTotal += Number(a.Product_Price);
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
  }
  removeAllCart(){
    this.cartItemList = []
    this.productList.next(this.cartItemList);
  }
  set_cart(){
        localStorage.setItem("cart_data",JSON.stringify(this.cartItemList));
        localStorage.setItem("cart_total",JSON.stringify(this.getTotalPrice()));
  }
  // get_cart(){
  //   if(localStorage.getItem("cart_data") !== null){
  //     this.localsetItem=localStorage.getItem("cart_data")
  //     this.total=localStorage.getItem("cart_total")
  //     return JSON.parse(this.localsetItem,this.total)
  //   }else{
  //     return false
  //   }
  // }
}