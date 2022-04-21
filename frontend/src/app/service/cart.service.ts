import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  localsetItem!:string|null
  public cartItemList : any =[]
  public productList = new BehaviorSubject<any>([]);
  public search = new BehaviorSubject<string>("");

  constructor() {
    // this.localsetItem=localStorage.getItem('data')
    // if(this.localsetItem == null)
    // {
    //   this.cartItemList  = [];
    // }
    // else
    //     {
    //   this.cartItemList=JSON.parse(this.localsetItem);
    //     }
  }
  getProducts(){
    return this.productList.asObservable();
  }
  setProduct(product : any){
    this.cartItemList.push(...product)
    this.productList.next(product);
    // this.getitem() 
  }
  // getitem(){
  //   this.cartItemList = JSON.parse(localStorage.getItem('data'));
  // }
  addtoCart(product : any){
    this.cartItemList.map((a:any, index:any)=>{
      if(a.ID=== product.ID){
        console.log(a.ID)
      }
    })
    
    this.cartItemList.push(product);
    // localStorage.setItem("data",JSON.stringify(this.cartItemList));
    this.productList.next(this.cartItemList);
    this.getTotalPrice();
   
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
}