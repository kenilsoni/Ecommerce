import { Component, ElementRef, OnInit, QueryList, ViewChild, ViewChildren } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { CartService } from 'src/app/service/cart.service';
import { ProductService } from 'src/app/service/product.service';
import { environment } from 'src/environments/environment';
@Component({
  selector: 'app-product-data',
  templateUrl: './product-data.component.html',
  styleUrls: ['./product-data.component.css']
})
export class ProductDataComponent implements OnInit {
  registerval!: FormGroup;
  Image_path:string=environment.IMAGE_URL
  imgCollection: Array<object> = [];
  constructor(private product: ProductService, public route: ActivatedRoute, private cartService : CartService,private formbuilder:FormBuilder) { }
  product_id!:number
  product_details:any=[]
  formgroup!:FormGroup
  addtocart_alert:boolean=false
  user_id!:number
  islogin!:boolean
  size_details:any=[]
  @ViewChild("quantity")
  quantity!:ElementRef;
  @ViewChild("size") size!:ElementRef
  ngOnInit(): void {
    this.route.params.subscribe(data => {
      this.product_id = data['id'];
    })
    this.getproduct()
    this.getuser_id()
    this.get_size(this.product_id)
    this.get_currency()
  }
  getproduct(){
    this.product.getproduct_single(this.product_id).subscribe(data=>{
      this.product_details=data['data']
      for(let res of data['img']){
        this.imgCollection.push({
          image: this.Image_path+'/'+res.all_img,
          thumbImage: this.Image_path+'/'+res.all_img,
          alt: 'Image 1',
        })
      }
      
    })
  }
  get_size(id: number) {
    this.cartService.getsizeby_id(id).subscribe(data => {
      this.size_details = data
      
    })
  }
  getuser_id(){
    let data=this.cartService.get_id()
    if(data){
      this.user_id=data['id']
    }
   
  }
  addtocart(e:any){
    if(this.user_id){
      e.Product_Quantity=this.quantity.nativeElement.value
      e.Size_id=this.size.nativeElement.value
      e.user_id=this.user_id
      this.cartService.addtoCart(e).subscribe(data=>{
        if(data['message']){
          this.addtocart_alert=true
      setTimeout(() => {
        this.addtocart_alert=false
      }, 4000);
          }
      });
    }else{
      this.islogin=true
    }
  }
  add_wishlist(id:number){
    if(this.user_id){
      this.product.add_wishlist(this.user_id,id).subscribe(data=>{
        console.log(data)
        if(data['message']){
          alert("add")
        }else{
          alert("already available")
        }
      })
    }
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
