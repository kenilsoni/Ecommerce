import { Component, ElementRef, OnInit, QueryList, ViewChild, ViewChildren } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
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
  Image_path: string = environment.IMAGE_URL
  imgCollection: Array<object> = [];
  constructor(private toastr: NgToastService, private product: ProductService, public route: ActivatedRoute, private cartService: CartService, private formbuilder: FormBuilder) { }
  product_id!: number
  product_details: any = []
  formgroup!: FormGroup
  reviewval!: FormGroup
  addtocart_alert: boolean = false
  user_id!: number
  islogin!: boolean
  size_details: any = []
  @ViewChild("quantity")
  quantity!: ElementRef;
  @ViewChild("size") size!: ElementRef
  @ViewChild("review_window") review_window!: ElementRef
  ngOnInit(): void {
    this.route.params.subscribe(data => {
      this.product_id = data['id'];
    })
    this.getproduct()
    this.getuser_id()
    this.get_size(this.product_id)
    this.get_currency()
    this.reviewval = this.formbuilder.group({
      star: [''],
      review: ['', [Validators.required]],
    })
    this.get_review()
  }
  getproduct() {
    this.product.getproduct_single(this.product_id).subscribe(data => {
      this.product_details = data['data']
      for (let res of data['img']) {
        this.imgCollection.push({
          image: this.Image_path + '/' + res.all_img,
          thumbImage: this.Image_path + '/' + res.all_img,
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
  getuser_id() {
    let data = this.cartService.get_id()
    if (data) {
      this.user_id = data['id']
    }
  }
  addtocart(e: any) {
    if (this.user_id) {
      e.Product_Quantity = this.quantity.nativeElement.value
      e.Size_id = this.size.nativeElement.value
      e.user_id = this.user_id
      if (this.size.nativeElement.value !== '') {
        this.cartService.addtoCart(e).subscribe(data => {
          if (data['message']) {
            this.addtocart_alert = true
            setTimeout(() => {
              this.addtocart_alert = false
            }, 4000);
          }
        });
      } else {
        this.toastr.info({ detail: 'Select Size!', summary: 'Please Select Size!' });
      }
    }
    else {
      this.islogin = true
      this.toastr.error({ detail: 'Error!', summary: 'Please Login First!' });
    }
  }
  add_wishlist(id: number, price_id: any) {
    if (this.user_id) {
      this.product.add_wishlist(this.user_id, id, price_id).subscribe(data => {
        if (data['message']) {
          this.toastr.success({ detail: 'Success!', summary: 'Product added successfully!' });
        } else {
          this.toastr.info({ detail: 'Available!', summary: 'Product is already available!' });
        }
      })
    } else {
      this.toastr.error({ detail: 'Login First!', summary: 'Please Login First!' });
    }
  }
  selectedCurrency: any
  get_currency() {
    this.product.set_currency.subscribe(data => {
      if (data.length > 0) {
        this.selectedCurrency = data
        this.getproduct()
      } else {
        this.selectedCurrency = 'INR'
      }
    })
  }
  convertWithCurrencyRate(value: number, currency: string) {
    return this.product.convertWithCurrencyRate(value, currency)
  }

  //review
  stars: number[] = [1, 2, 3, 4, 5];
  selectedValue!: number;
  countStar(star: any) {
    this.selectedValue = star;
    this.reviewval.controls['star'].setErrors(null)
  }
  review() {
    if (this.review_window.nativeElement.style.display == 'block') {
      this.review_window.nativeElement.style.display = 'none'
    } else {
      this.review_window.nativeElement.style.display = 'block'
    }
  }
  review_details: any = []
  review_load: number = 2
  initial!: number
  end!: number
  review_count: boolean = true
  average_rate:any
  average_rate_round:any
  get_review() {
    this.product.get_reviewid(this.product_id, this.review_load).subscribe((data: any) => {
      if (data['message']) {
        this.review_details = data['message']
        this.average_rate=data['average'][0].avg
        this.average_rate_round=Math.round(data['average'][0].avg)
      } else {
        this.review_details = []
      }
      if (this.initial) {
        this.end = this.review_details.length
        if (this.end - this.initial < 2) {
          this.review_count = false
        }
      }
    })
  }
  load_review(e: number) {
    this.review_load = e + 2;
    this.initial = this.review_details.length
    this.get_review()
  }
  add_review() {
    if (this.user_id) {
      if (this.reviewval.valid) {
        if (this.selectedValue == undefined) {
          this.reviewval.controls['star'].setErrors({ invalid: true })
        } else {
          this.product.add_review_data(this.user_id, this.product_id, this.reviewval.value.review, this.selectedValue).subscribe((data: any) => {
            if (data['message']) {
              this.get_review()
              this.reviewval.reset()
              this.reviewval.controls['review'].setErrors(null)
              this.selectedValue=0
              this.toastr.success({ detail: 'Success!', summary: 'Product review added successfully!' });
            } else {
              this.toastr.error({ detail: 'Error!', summary: 'Something went wrong!' });
            }
          })
        }
      }
    } else {
      this.toastr.error({ detail: 'Error!', summary: 'Please Login First!' });
    }
  }
}
