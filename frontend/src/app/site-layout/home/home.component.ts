import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CartService } from 'src/app/service/cart.service';
import { ProductService } from 'src/app/service/product.service';
import { environment } from 'src/environments/environment';
import { NgToastService } from 'ng-angular-popup';
import { OwlOptions } from 'ngx-owl-carousel-o';
import { product } from 'src/app/interface/product';
import { testimonial } from 'src/app/interface/testimonial';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  product_data: Array<product> = []
  user_id!: number
  imgCollection: Array<object> = [];
  image_url: string = environment.IMAGE_URL
  testimonial_data: Array<testimonial> = []
  selectedCurrency!: string

  constructor(private toastr: NgToastService, private product: ProductService, private cartService: CartService, private route: ActivatedRoute, private router: Router) { }

  ngOnInit(): void {
    this.getuser_id()
    this.getproduct_trend()
    this.getslider()
    this.get_currency()
    this.get_testimonial()
  }
  get_testimonial() {
    this.product.get_testimonial().subscribe((data: any) => {
      if (data['data']) {
        this.testimonial_data = data['data']
      }
    })
  }
  tesimonial: OwlOptions = {
    loop: true,
    autoplay: true,
    mouseDrag: true,
    touchDrag: true,
    pullDrag: true,
    dots: false,
    navSpeed: 500,
    navText: ['', ''],
    responsive: {
      0: {
        items: 1
      },
      400: {
        items: 1
      },
      740: {
        items: 1
      },
      940: {
        items: 1
      },
    },
    // nav: true
  }

  getproduct_trend() {
    this.product.gettrend_product(8, 1).subscribe(data => {
      this.product_data = data['data']
    })
  }
  getuser_id() {
    let data = this.cartService.get_id()
    if (data) {
      this.user_id = data['id']
    }
  }
  addtocart(e: any) {
    if (this.user_id) {
      e.Product_Quantity = 1
      e.user_id = this.user_id
      this.cartService.addtoCart(e).subscribe(data => {
        if (data['message'] == "available") {
          this.toastr.success({ detail: 'Success!', summary: 'Product added successfully!' });
        } else if (data['message'] == "limit_reach") {
          this.toastr.error({ detail: 'Error!', summary: 'No more product available!' });
        } else {
          this.toastr.error({ detail: 'Error!', summary: 'Something went wrong!' });
        }
      });
    }
    else {
      this.toastr.error({ detail: 'Error!', summary: 'Please Login First!' });
    }
  }
  getslider() {
    this.product.get_slider().subscribe((data: any) => {
      for (let res of data['data']) {
        this.imgCollection.push({
          image: this.image_url + '/' + res.Image_Path,
          thumbImage: this.image_url + '/' + res.Image_Path,
          alt: 'Image 1',
        })
      }
    })
  }
  get_currency() {
    this.product.set_currency.subscribe(data => {
      if (data.length > 0) {
        this.selectedCurrency = data
      } else {
        this.selectedCurrency = 'INR'
      }
    })
  }
  get_women_collection() {
    this.product.getcategory().subscribe((response: any) => {
      for (let cat_data of response.data) {
        if (cat_data['Category_Name'] == 'WOMEN') {
          this.router.navigate(['/product/' + cat_data['Category_Name'] + '/' + cat_data['ID'] + '']);
        }
      }
    })
  }
  convertWithCurrencyRate(value: number, currency: string) {
    return this.product.convertWithCurrencyRate(value, currency)
  }
}
