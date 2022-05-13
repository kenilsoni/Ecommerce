import { Component, OnInit } from '@angular/core';
import { Route, Router } from '@angular/router';
import { CartService } from 'src/app/service/cart.service';
import { ProductService } from 'src/app/service/product.service';
import { UserService } from 'src/app/service/user.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-wishlist',
  templateUrl: './wishlist.component.html',
  styleUrls: ['./wishlist.component.css']
})
export class WishlistComponent implements OnInit {

  constructor(private product:ProductService,private user:UserService,private cartService:CartService,private router:Router) { }
  productdata:any=[]
  user_id!:number
  image_url: string = environment.IMAGE_URL

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
      if(data['message']){
        this.router.navigate(['/cart']);
        }
    });
  }
  remove_item(id:number){
    this.product.remove_item(this.user_id,id).subscribe(data=>{
      // console.log(data)
      if(data['message']){
        this.get_wishlist()
      }

    })
  }
  selectedCurrency:any
  get_currency(){
    if(this.product.get_currencyval()){
      let currency_val=this.product.get_currencyval()
      this.selectedCurrency=currency_val
    }else{
      this.selectedCurrency='INR'
    }
  }
  convertWithCurrencyRate(value: number, currency: string){
    if(currency=='USD'){
      return value/75;
    }else if(currency=='INR'){
      return value;
    }else{
      return value;
    }
  }

}
