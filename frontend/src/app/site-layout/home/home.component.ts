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
  imgCollection: Array<object> = [];
  image_url: string = environment.IMAGE_URL
  constructor(private product:ProductService,private cartService : CartService,private route:ActivatedRoute,  private router: Router) { }

  ngOnInit(): void {
    this.getuser_id()
    this.getproduct_trend()
    this.getslider()
    this.get_currency()
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
  getslider(){
    this.product.get_slider().subscribe((data:any)=>{

      for(let res of data['data']){
        this.imgCollection.push({
          image: this.image_url+'/'+res.Image_Path,
          thumbImage: this.image_url+'/'+res.Image_Path,
          alt: 'Image 1',
        })
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
