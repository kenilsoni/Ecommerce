import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from 'src/app/service/product.service';
import { Options, LabelType } from "@angular-slider/ngx-slider";
import { SliderComponent } from '@angular-slider/ngx-slider/slider.component';





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
  productdata: any
  cat_name!: string
  cat_data!: any
  subcat_name!: string
  color!: any
  size!: any
  price!: any
  // count!: any
  product_id!: any
  mymodel = 0

  minValue: number = 100;
  maxValue: number = 400;
  options: Options = {
    floor: 0,
    ceil: 500,
    translate: (value: number, label: LabelType): string => {
      switch (label) {
        case LabelType.Low:
          return "<b>Min price:</b> $" + value;
        case LabelType.High:
          return "<b>Max price:</b> $" + value;
        default:
          return "$" + value;
      }
    }
  };

  ngOnInit(): void {
    this.route.params.subscribe(data => {
      this.cat_id = data['cid'];
      this.subcat_id = data['sid']
      this.cat_name = data['cname'];
      this.subcat_name = data['sname'];
      this.product.getproductbycat_id(this.cat_id).subscribe(data => {
        this.productdata = data['data']
        if (this.subcat_id !== undefined) {
          this.getproductbysubcat_id();
        }
      })
    })
    this.getsubcategory();
    this.getcolor();
    this.getsize();
    this.getcount();
  }
  getproductbysubcat_id() {
    this.product.getproductbysubcat_id(this.subcat_id, this.cat_id).subscribe(data => {
      this.productdata = data['data']
      // console.log(data['data'])

    })
  }
  getcount() {
    this.product.getprice().subscribe(data => {
      this.price = data['data']
      //  console.log(this.price.min);
    })
  }
  getsubcategory() {
    this.product.getcategory_id(this.cat_id).subscribe(data => {
      this.cat_data = data['main']
      // console.log(data)
      // this.product.gettotal_count(this.cid,this.sid).subscribe(data=>{
      //   this.price=data['data']
      //     //  console.log(this.price.min);
      // })
    })
  }
  getsize() {
    this.product.getsize().subscribe(data => {
      this.size = data['data']
      // console.log(data['data']);
    })
  }
  getcolor() {

    this.product.getcolor().subscribe(data => {
      this.color = data['data']
      // console.log(data['data'])
    })
  }
  // newdata:any=[]
  category_filter(e: any) {
    if (e.target.checked) {
      this.product.getproductbysubcat_id(e.target.value, this.cat_id).subscribe(data => {
        this.productdata = data['data']

        // console.log(data['data'])

      })
      // console.log(e.target.value.split('/'));
      // const arr=e.target.value.split('/');

      // this.router.navigate(['/product/'+this.cname+'/'+this.cid+'/'+arr[1]+'/'+arr[0]]);
      // console.log(arr[1]);
    } else {
      this.product.getproductbycat_id(this.cat_id).subscribe(data => {
        this.productdata = data['data']

        if (this.subcat_id !== undefined) {
          this.product.getproductbysubcat_id(this.subcat_id, this.cat_id).subscribe(data => {
            this.productdata = data['data']
            // console.log(data['data'])

          })
        }
      })
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
    this.product.getproductbysize_id(e.target.value, this.cat_id).subscribe(data => {
      this.productdata = data['data']
    })
  }

  updateSetting(e: any) {
    console.log(e.min)
    var el = this['element'].nativeElement;
    console.log(el)
  }
  color_radio: any
  reset_radiobtn() {
    this.color_radio = null

    this.product.getproductbycat_id(this.cat_id).subscribe(data => {
      this.productdata = data['data']

      if (this.subcat_id !== undefined) {
        this.product.getproductbysubcat_id(this.subcat_id, this.cat_id).subscribe(data => {
          this.productdata = data['data']
          // console.log(data['data'])

        })
      }
    })

  }

}
