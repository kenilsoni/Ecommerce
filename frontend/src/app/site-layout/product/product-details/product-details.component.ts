import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from 'src/app/service/product.service';
import { Options, LabelType } from "@angular-slider/ngx-slider";
import { SliderComponent } from '@angular-slider/ngx-slider/slider.component';
import { environment } from 'src/environments/environment';





@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.css']
})
export class ProductDetailsComponent implements OnInit {
  [x: string]: any;
  sorted_data: any;

  constructor(private product: ProductService, public route: ActivatedRoute) { }
  cat_id!: number
  subcat_id!: number
  productdata: any=[]
  cat_name!: string
  cat_data!: any
  subcat_name!: string
  color!: any
  size!: any
  price!: any
  product_id!: any
  color_radio: any
  // min!:number
  // mymodel = 0
  load_product=environment.load_product



  minValue: number =0;
  maxValue: number= 0;
  options: Options = {
    floor: 0,
    ceil: 0,
    
  };

  ngOnInit(): void {
    this.route.params.subscribe(data => {
      this.cat_id = data['cid'];
      this.subcat_id = data['sid']
      this.cat_name = data['cname'];
      this.subcat_name = data['sname'];
      this.getproductby_cat();
      this.getsubcategory();
      this.getcolor();
      this.getsize();
      this.getcount();
    })
 
  }
  getproductby_cat(){
    this.product.getproductbycat_id(this.cat_id,this.load_product).subscribe(data => {
      this.productdata = data['data']
      if (this.subcat_id !== undefined) {
        this.getproductbysubcat_id();
      }
    })  
  }
  getproductbysubcat_id() {
    this.product.getproductbysubcat_id(this.subcat_id, this.cat_id,this.load_product).subscribe(data => {
      this.productdata = data['data']
    })
  }
  getcount() {
    this.product.getprice().subscribe(data => {
      // this.price = data['data']
      for(let val of data['data']){
        this.options={
          floor:val.min,
          ceil:val.max
        }
        
      }
      
    })
    
  }
  getsubcategory() {
    this.product.getcategory_id(this.cat_id).subscribe(data => {
      this.cat_data = data['main']
    })
  }
  getsize() {
    this.product.getsize(this.cat_id).subscribe(data => {
      this.size = data['main']
    })
  }
  getcolor() {
    this.product.getcolor(this.cat_id).subscribe(data => {
      this.color = data['main']
    })
  }

  // newdata:any=[]
  category_filter(e: any) {
    if (e.target.checked) {
     
      // console.log(this.productdata)
      this.product.getproductbysubcat_id(e.target.value, this.cat_id,this.load_product).subscribe(data => {
        this.productdata = data['data']
      })
    } else {
      this.getproductby_cat()
    }
  }
  getproductby_color(e: any) {
    // console.log(e.target.value)
    if (e.target.value === 'on') {
      this.product.getproductbyclr_id(e.target.id, this.cat_id).subscribe(data => {
        this.productdata = data['data']
      })
    }
  }
  size_filter(e: any) {
    if (e.target.checked) {
    this.product.getproductbysize_id(e.target.value, this.cat_id).subscribe(data => {
      this.productdata = data['data']
    })}
    else{
      this.getproductby_cat()
    
    }
  }

  updateSetting(e: any) {
    console.log(e.min)
    var el = this['element'].nativeElement;
    console.log(el)
  }


  reset_radiobtn() {
    this.color_radio = null
    this.getproductby_cat()
  }

  loadmore_product(e:number){
    this.load_product=e+3;
    this.getproductby_cat()
  }
  sortby(e:any){
    if(e.target.value !== ''){
      this.product.getorderby(e.target.value,this.cat_id).subscribe(data=>{
        this.productdata=data['data']
      })
    }
  }

  sliderEvent(e:any){
    this.product.price_filter(e.value,e.highValue,this.load_product).subscribe(data=>{
      this.productdata=data['data']
    })
     
  }
}
