import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/service/cart.service';
import { ProductService } from 'src/app/service/product.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  product_data:any=[]
  constructor(private product:ProductService,private cartService : CartService) { }

  ngOnInit(): void {
    this.getproduct_trend()
  }
  getproduct_trend(){
    this.product.gettrend_product(8,1).subscribe(data=>{
      this.product_data=data['data']
    })
  }
  addtocart(e:any){
    e.Product_Quantity=1
    this.cartService.addtoCart(e);
    // this.addtocart_alert=true
    // setTimeout(() => {
    //   this.addtocart_alert=false
    // }, 4000);
    // console.log(qty)
  }
}
