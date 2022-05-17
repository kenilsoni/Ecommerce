import { Component, ElementRef, OnInit, QueryList, ViewChild, ViewChildren } from '@angular/core';
import { CartService } from 'src/app/service/cart.service';
import { ProductService } from 'src/app/service/product.service';
import { UserService } from 'src/app/service/user.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  products: any = [];
  grandTotal: number = 0;
  image_url: string = environment.IMAGE_URL
  country_data: any = []
  state_details: any = []
  tax: any
  final_amount: number = 0
  service_tax: number = 0
  color_details: any = []
  size_details: any = []
  user_id!: number

  @ViewChild("state") state!: ElementRef
  @ViewChild("country") country!: ElementRef
  @ViewChildren("color") color_change!: QueryList<ElementRef>
  @ViewChildren("quantity") quantity!: QueryList<ElementRef>
  @ViewChildren("size") size_change!: QueryList<ElementRef>
  @ViewChildren("color_text") color_text!: QueryList<ElementRef>
  @ViewChildren("size_text") size_text!: QueryList<ElementRef>
  handler: any = null;

  constructor(private cartService: CartService, private userservice: UserService, private productservice: ProductService) { }

  ngOnInit(): void {

    this.getuser_id()
    this.getcart_data()
    this.get_taxdetails()
    // this.loadStripe();
    this.get_currency()
    this.get_shippingadd()
  }
  getuser_id() {
    let data = this.cartService.get_id()
    if (data) {
      this.user_id = data['id']
    }
  }
  get_color(id: number) {
    this.cartService.getcolorby_id(id).subscribe(data => {
      this.color_details = data
    })
  }
  get_size(id: number) {
    this.cartService.getsizeby_id(id).subscribe(data => {
      this.size_details = data
    })
  }
  getcart_data() {
    this.cartService.getProducts(this.user_id).subscribe(data => {
      if (data['data']) {
        this.products = data['data'];
        this.final_amount = this.get_total()
        this.grandTotal = this.get_total()
        console.log(this.products)
      } else {
        this.products = []
        this.grandTotal = 0
        this.final_amount = 0
      }
    })

  }
  get_taxdetails() {
    this.cartService.get_country().subscribe(data => {
      this.country_data = data['data']
    })
  }
  removeItem(cart_id: any) {
    this.cartService.removeCartItem(cart_id).subscribe();
    this.getcart_data()
    this.service_tax = 0
    this.state.nativeElement.value = ''
    this.country.nativeElement.value = ''
    this.getcart_data()
    this.grandTotal = this.get_total()
  }
  emptycart() {
    this.cartService.removeAllCart(this.user_id).subscribe();
    this.getcart_data()
    this.grandTotal = 0
    this.final_amount = 0
    this.service_tax = 0
    this.state.nativeElement.value = ''
    this.country.nativeElement.value = ''
    this.getcart_data()
  }
  edit_product(product_id: number, cart_id: number) {
    this.get_color(product_id)
    this.get_size(product_id)
    this.hide_dropdown()
    this.display_text()
    this.display_dropdownid(cart_id)
    this.hide_textid(cart_id)
  }
  get_state(e: any) {
    if (e.target.value == "") {
      this.state.nativeElement.value = ''
    } else {
      this.cartService.get_state(e.target.value).subscribe(data => {
        this.state_details = data['data']
      })
    }
  }
  get_total() {
    let grandTotal = 0;
    this.products.map((a: any) => {
      grandTotal += Number(a.Total_Amount);
    })
    return grandTotal;
  }
  update_cart() {
    this.hide_dropdown()
    this.display_text()
    this.getcart_data()
    this.service_tax = 0
    this.state.nativeElement.value = ''
    this.country.nativeElement.value = ''

  }
  find_tax(e: any) {
    let number = Number(this.final_amount)
    let percentToGet = Number(e.target.value)
    let percent = (percentToGet / 100) * number
    this.service_tax = percent
    this.final_amount = percent + this.final_amount
  }
  change_color(e: any) {
    this.color_change.forEach((element) => {
      if (e.target.id == element.nativeElement.id) {
        let color_id = element.nativeElement.value
        this.products.forEach((element: any) => {
          if (element.ID == e.target.id) {
            element.Color_ID = color_id
            this.cartService.update_product(element).subscribe()
          }
        });
      }
    })
  }
  change_size(e: any) {
    this.size_change.forEach((element) => {
      if (e.target.id == element.nativeElement.id) {
        let size_id = element.nativeElement.value
        // let assign_size = myArray[0]
        this.products.forEach((element: any) => {
          if (element.ID == e.target.id) {
            element.Size_ID = size_id
            this.cartService.update_product(element).subscribe()
          }
        });
      }
    })
  }
  change_quantity(e: any) {
    this.quantity.forEach((element) => {
      if (e.target.id == element.nativeElement.id) {
        let quantity = element.nativeElement.value
        this.products.forEach((element: any) => {
          if (element.ID == e.target.id) {
            element.Quantity = quantity
            element.Total_Amount = quantity * element.Unit_Price
            this.cartService.update_product(element).subscribe()
          }
        });
      }
    })
  }
  hide_dropdown() {
    this.color_change.forEach((element) => {
      element.nativeElement.style.display = 'none';
    })
    this.size_change.forEach((element) => {
      element.nativeElement.style.display = 'none';
    })
  }
  display_dropdown() {
    this.color_change.forEach((element) => {
      element.nativeElement.style.display = 'block';
    })
    this.size_change.forEach((element) => {
      element.nativeElement.style.display = 'block';
    })
  }
  hide_text() {
    this.color_text.forEach((element) => {
      element.nativeElement.hidden = true;
    })
    this.size_text.forEach((element) => {
      element.nativeElement.hidden = true;
    })
  }
  display_text() {
    this.color_text.forEach((element) => {
      element.nativeElement.hidden = false;
    })
    this.size_text.forEach((element) => {
      element.nativeElement.hidden = false;
    })
  }
  //by id
  hide_dropdownid(id: number) {
    this.color_change.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'none';
      }
    })
    this.size_change.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'none';
      }
    })
  }
  display_dropdownid(id: number) {
    this.color_change.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'block';
      }
    })
    this.size_change.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'block';
      }
    })
  }
  hide_textid(id: number) {
    this.color_text.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.hidden = true;
      }
    })
    this.size_text.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.hidden = true;
      }
    })
  }
  display_textid(id: number) {
    this.color_text.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.hidden = false;
      }
    })
    this.size_text.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.hidden = false;
      }
    })
  }

  token_checkout!: any

  get_shippingadd() {
    this.productservice.get_shipadd(this.user_id).subscribe((data: any) => {
      for (let val of data['data']) {
        this.products.forEach((element: any) => {
          element.tax = val['tax']
        })
      }
    })
  }
  pay() {
    console.log(this.products);
    var stripe = (<any>window).Stripe(environment.PUBLISHER_KEY)
    this.productservice.checkout_product(this.products).subscribe((data: any) => {
      stripe.redirectToCheckout({ sessionId: data })
    });
  }

  loadStripe() {
    if (!window.document.getElementById('stripe-script')) {
      var s = window.document.createElement("script");
      s.id = "stripe-script";
      s.type = "text/javascript";
      s.src = "https://checkout.stripe.com/checkout.js";
      s.onload = () => {
        this.handler = (<any>window).StripeCheckout.configure({
          key: environment.PUBLISHER_KEY,
          locale: 'auto',
        });
      }

      window.document.body.appendChild(s);
    }
  }
  selectedCurrency: any
  get_currency() {
    if (this.productservice.get_currencyval()) {
      let currency_val = this.productservice.get_currencyval()
      this.selectedCurrency = currency_val
    } else {
      this.selectedCurrency = 'INR'
    }
  }
  convertWithCurrencyRate(value: number, currency: string) {
    if (currency == 'USD') {
      return value / 75;
    } else if (currency == 'INR') {
      return value;
    } else {
      return value;
    }
  }
}
