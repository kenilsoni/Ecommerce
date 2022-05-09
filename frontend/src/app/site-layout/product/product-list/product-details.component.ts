import { Component, ElementRef, OnInit, QueryList, ViewChildren } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ProductService } from 'src/app/service/product.service';
import { Options, LabelType } from "@angular-slider/ngx-slider";
import { SliderComponent } from '@angular-slider/ngx-slider/slider.component';
import { environment } from 'src/environments/environment';
import { CartService } from 'src/app/service/cart.service';
import { FormBuilder, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.css']
})
export class ProductDetailsComponent implements OnInit {
  [x: string]: any;
  sorted_data: any;
  user_id!:any
  image_url: string = environment.IMAGE_URL
  constructor(private product: ProductService, public route: ActivatedRoute, private cartService: CartService, private formbuilder: FormBuilder,private router: Router) { }
  cat_id!: number
  subcat_id!: number
  productdata: any = []
  cat_name!: string
  cat_data!: any
  subcat_name!: string
  color!: any
  size!: any
  price!: any
  product_id!: any
  color_radio: any
  checkval!: FormGroup
  subcat_arr: any = []
  size_arr: any = []
  check_val: any
  ischeck!: boolean
  load_product = environment.load_product
  order_arr: any = []
  clr_arr: any = []
  slider_arr: any = []
  initial!: number
  end!: number
  product_count: boolean = true

  @ViewChildren("subcat_checkbox")
  subcat_checkbox!: QueryList<ElementRef>;
  @ViewChildren("order")
  order!: QueryList<ElementRef>;
  @ViewChildren("size_checkbox")
  size_checkbox!: QueryList<ElementRef>;
  @ViewChildren("getcolorval")
  getcolorval!: QueryList<ElementRef>;

  minValue: number = 0;
  maxValue: number = 0;
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
      this.getuser_id()
    })
  }
  getproductby_cat() {
    this.product.getproductbycat_id(this.cat_id, this.load_product).subscribe(data => {
      this.productdata = data['data']
      if (this.subcat_id !== undefined) {
        this.getproductbysubcat_id();
      }      console.log(this.productdata)
    })
    // console.log(this.checkBoxValue.ID)
  }
  getproductbysubcat_id() {
    this.product.getproductbysubcat_id(this.subcat_id, this.cat_id, this.load_product).subscribe(data => {
      this.productdata = data['data']
      this.product.getcategory_id(this.cat_id).subscribe(data => {
        this.cat_data = []
        for (let val of data['main']) {
          if (this.subcat_id == val['ID']) {
            this.cat_data.push(val);
            this.ischeck = true
          }
        }
      })
    })
  }
  getcount() {
    this.product.getprice().subscribe(data => {
      // this.price = data['data']
      for (let val of data['data']) {
        this.options = {
          floor: val.min,
          ceil: val.max
        }
        this.maxValue = val.max
        this.minValue = val.min
      }
    })
  }
  getsubcategory() {
    this.product.getcategory_id(this.cat_id).subscribe(data => {
      this.cat_data = data['main']
      // console.log(this.cat_data)
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
  reset_radiobtn() {
    this.color_radio = null
    this.getcolorval.forEach((element) => {
      if (element.nativeElement.checked) {
        element.nativeElement.checked = false;
      }
    });
    this.clr_arr = []
    this.allproduct_id()
  }
  reset_catbtn() {
    this.subcat_checkbox.forEach((element) => {
      element.nativeElement.checked = false;
    });
    this.subcat_arr = []
    this.allproduct_id()
  }
  reset_sizebtn() {
    this.size_checkbox.forEach((element) => {
      element.nativeElement.checked = false;
    });
    this.size_arr = []
    this.allproduct_id()
  }
  loadmore_product(e: number) {
    this.load_product = e + 3;
    this.initial = this.productdata.length
    this.allproduct_id()
  }
  sortby(e: any) {
    this.allproduct_id()
  }
  sliderEvent(e: any) {
    this.slider_arr = []
    this.slider_arr.push(e.value, e.highValue)
    this.allproduct_id()
  }
  addtocart(e: any) {
    e.Product_Quantity=1
    e.user_id=this.user_id
    this.cartService.addtoCart(e).subscribe(data=>{
      if(data['message']){
        this.router.navigate(['/cart']);
        }
    });
  }
  getuser_id(){
    let data=this.cartService.get_id()
    if(data){
      this.user_id=data['id']
    }
   
  }
  allproduct_id() {
    this.size_arr = []
    this.subcat_arr = []
    this.clr_arr = []
    this.order_arr = []
    this.subcat_checkbox.forEach((element) => {
      if (element.nativeElement.checked) {
        this.subcat_arr.push(element.nativeElement.id)
      }
    });
    this.getcolorval.forEach((element) => {
      if (element.nativeElement.checked) {
        this.clr_arr.push(element.nativeElement.id)
      }
    });
    this.size_checkbox.forEach((element) => {
      if (element.nativeElement.checked) {
        this.size_arr.push(element.nativeElement.id)
      }
    });
    this.order.forEach((element) => {
      this.order_arr.push(element.nativeElement.value)
    });
    if (this.slider_arr.length == 0) {
      this.slider_arr[0] = this.minValue
      this.slider_arr[1] = this.maxValue
    }
    this.product.all_product_filter(this.order_arr, this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.clr_arr, this.size_arr).subscribe(data => {
      if (data['data'] !== undefined) {
        this.productdata = data['data']
        if (this.initial) {
          this.end = this.productdata.length
          if (this.end - this.initial < 9) {
            this.product_count = false
          }
        }
      } else {
        this.productdata = []
      }
    })
  }
}
