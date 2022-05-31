import { Component, OnInit } from '@angular/core';
import { Route, Router } from '@angular/router';
import { CartService } from 'src/app/service/cart.service';
import { ProductService } from 'src/app/service/product.service';
import { UserService } from 'src/app/service/user.service';
import { environment } from 'src/environments/environment';
import { NgToastService } from 'ng-angular-popup';
import { product } from 'src/app/interface/product';
@Component({
  selector: 'app-wishlist',
  templateUrl: './wishlist.component.html',
  styleUrls: ['./wishlist.component.css']
})
export class WishlistComponent implements OnInit {
  productdata:Array<product>=[]
  user_id!:number
  image_url: string = environment.IMAGE_URL
  selectedCurrency:any

  constructor(private toastr: NgToastService,private product:ProductService,private user:UserService,private cartService:CartService,private router:Router) { }

  ngOnInit(): void {
    this. get_userid()
    this.get_wishlist()
    this.get_currency()
  }
  get_userid(){
    let data=this.user.get_user()
    this.user_id=data['id']
  }
 
  get_wishlist(){
    this.product.get_wishlist(this.user_id).subscribe(data=>{
      if(data['data']){
        this.productdata=data['data']
      }else{
        this.productdata=[]
      }
    })
  }
  addtocart(e:any){
    e.Product_Quantity=1
    e.user_id=this.user_id
    this.cartService.addtoCart(e).subscribe(data=>{
      if (data['message'] == "available") {
        this.toastr.success({ detail: 'Success!', summary: 'Product added successfully!' });
      } else if (data['message'] == "limit_reach") {
        this.toastr.error({ detail: 'Error!', summary: 'No more product available!' });
      }else{
        this.toastr.error({ detail: 'Error!', summary: 'Something went wrong!' });
      }
    });
  }
  remove_item(id:number){
    this.product.remove_item(this.user_id,id).subscribe(data=>{
      if(data['message']){
        this.toastr.success({detail:'Success!', summary:'Product remove successfully!'});
        this.get_wishlist()
      }else{
        this.toastr.error({detail:'Error!', summary:'Something went wrong!'});
      }
    })
  }
  get_currency(){
    this.product.set_currency.subscribe(data=>{
      if(data.length>0){
        this.selectedCurrency = data
        this.get_wishlist()
      }else{
        this.selectedCurrency = 'INR'
      }
    })
  }
  convertWithCurrencyRate(value: number, currency: string) {
    return this.product.convertWithCurrencyRate(value,currency)
  }
}
