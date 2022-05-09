import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
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
  user_id!:number
  constructor(private product:ProductService,private cartService : CartService,private route:ActivatedRoute,  private router: Router) { }

  ngOnInit(): void {
    this.getuser_id()
    this.getproduct_trend()
    
  }
  getproduct_trend(){
    this.product.gettrend_product(8,1).subscribe(data=>{
      this.product_data=data['data']
    })
  }
  getuser_id(){
    let data=this.cartService.get_id()
    if(data){
      this.user_id=data['id']
      // console.log(this.user_id)
    }
   
  }
  addtocart(e:any){
    e.Product_Quantity=1
    e.user_id=this.user_id
    this.cartService.addtoCart(e).subscribe(data=>{
      if(data['message']){
      this.router.navigate(['/cart']);
      }

    });
  
    // this.addtocart_alert=true
    // setTimeout(() => {
    //   this.addtocart_alert=false
    // }, 4000);
    console.log(e)
  }


}
