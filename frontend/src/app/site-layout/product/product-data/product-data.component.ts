import { Component, OnInit } from '@angular/core';
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
  // imgCollection!: Array<object> 
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
      // console.log(data['img'])
      for(let res of data['img']){
        this.imgCollection.push({
          image: this.Image_path+'/'+res.all_img,
          thumbImage: this.Image_path+'/'+res.all_img,
          alt: 'Image 1',
          // title: 'Image 1'
        })
      }
      
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
