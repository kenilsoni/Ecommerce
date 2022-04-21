import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { CartService } from 'src/app/service/cart.service';
import { ProductService } from 'src/app/service/product.service';

@Component({
  selector: 'app-product-data',
  templateUrl: './product-data.component.html',
  styleUrls: ['./product-data.component.css']
})
export class ProductDataComponent implements OnInit {
  registerval!: FormGroup;

  constructor(private product: ProductService, public route: ActivatedRoute, private cartService : CartService,private formbuilder:FormBuilder) { }
  product_id!:number
  product_details:any=[]
  formgroup!:FormGroup
  addtocart_alert:boolean=false

  ngOnInit(): void {
    this.route.params.subscribe(data => {
      this.product_id = data['id'];
    })
    this.getproduct()
    // this.form()
    

  }
  getproduct(){
    this.product.getproduct_single(this.product_id).subscribe(data=>{
      this.product_details=data['data']
    })
  }
  addtocart(e:any){
    this.cartService.addtoCart(e);
    this.addtocart_alert=true
    setTimeout(() => {
      this.addtocart_alert=false
    }, 4000);
    // console.log(qty)
  }
  // form(){
  //   this.registerval = this.formbuilder.group({
  //     size: ['', [Validators.required]]
  //   })
  // }
  
}
