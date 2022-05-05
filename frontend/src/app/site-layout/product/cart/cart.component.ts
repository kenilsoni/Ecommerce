import { AfterViewInit, Component, ElementRef, OnInit, QueryList, ViewChild, ViewChildren } from '@angular/core';
import { CartService } from 'src/app/service/cart.service';
import { UserService } from 'src/app/service/user.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit, AfterViewInit {
  products: any = [];
  grandTotal!: number;
  image_url: string = environment.IMAGE_URL
  country_data: any = []
  state_details: any = []
  tax: any
  final_amount: number = 0
  service_tax: number = 0
  color_details: any = []
  size_details: any = []

  @ViewChild("state") state!: ElementRef
  @ViewChild("country") country!: ElementRef
  @ViewChildren("color") color_change!: QueryList<ElementRef>
  @ViewChildren("quantity") quantity!: QueryList<ElementRef>
  @ViewChildren("size") size_change!: QueryList<ElementRef>
  @ViewChildren("color_text") color_text!: QueryList<ElementRef>
  @ViewChildren("size_text") size_text!: QueryList<ElementRef>
  constructor(private cartService: CartService, private userservice: UserService) { }
  ngAfterViewInit(): void {
    this.hide_dropdown()
  }
  ngOnInit(): void {
    this.getcart_data()
    this.get_taxdetails()
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
    this.cartService.getProducts()
      .subscribe(res => {
        this.products = res;
        this.grandTotal = this.cartService.getTotalPrice();
        this.final_amount = this.grandTotal
      })
  }
  get_taxdetails() {
    this.cartService.get_country().subscribe(data => {
      this.country_data = data['data']
    })
  }

  removeItem(item: any) {
    this.cartService.removeCartItem(item);
    this.getcart_data()
    this.service_tax = 0
    this.state.nativeElement.value = ''
    this.country.nativeElement.value = ''
  }
  emptycart() {
    this.cartService.removeAllCart();
    this.getcart_data()
    this.final_amount = 0
    this.service_tax = 0
    this.state.nativeElement.value = ''
    this.country.nativeElement.value = ''
  }
  edit_product(id: number) {
    // console.log(id)
    // console.log(cid)
    // console.log(sid)
    this.get_color(id)
    this.get_size(id)
    this.display_dropdownid(id)
    this.hide_textid(id)
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
  update_cart() {
    this.hide_dropdown()
    this.display_text()
    // this.products.forEach((element: any) => {
    //   element.final_amount=this.final_amount

    // });
    this.cartService.update_product(this.products)
    this.getcart_data()
    console.log(this.products)
  }
  find_tax(e: any) {
    let number = Number(this.grandTotal)
    let percentToGet = Number(e.target.value)
    let percent = (percentToGet / 100) * number
    this.service_tax = percent
    this.final_amount = percent + this.grandTotal
  }
  change_color(e: any) {
    this.color_change.forEach((element) => {

      if (e.target.id == element.nativeElement.id) {
        let myArray = element.nativeElement.value.split(",");
        // console.log(myArray)
        // let assign_color = myArray[0]
        // console.log(e.target.class)
        this.color_text.forEach((element) => {
          if (e.target.id == element.nativeElement.id) {

            this.products.forEach((element: any) => {
              element.Color_name =myArray[0]
              element.Product_Color_ID =myArray[1]

            });
            // element.nativeElement.innerHTML = assign_color
          }
        })
      }
    })
  }
  change_size(e: any) {
    this.size_change.forEach((element) => {
      if (e.target.id == element.nativeElement.id) {
        let myArray = element.nativeElement.value.split(",");
        // let assign_size = myArray[0]
        this.size_text.forEach((element) => {
          if (e.target.id == element.nativeElement.id) {
            this.products.forEach((element: any) => {
              if(element.ID==e.target.id){
              element.Size_Name =myArray[0]
              element.Size_id =myArray[1]
              }
            });
            // element.nativeElement.innerHTML = assign_size
          }
        })
      }
    })
  }
  change_quantity(e: any) {  
  
    this.quantity.forEach((element) => {
      // console.log(element.nativeElement)
      if (e.target.id == element.nativeElement.id) {
        let quantity = element.nativeElement.value
        console.log(quantity)
        this.products.forEach((element: any) => {
          if(element.ID==e.target.id){
            element.Product_Quantity = quantity
          }
        });
      }
      console.log(this.products)
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
}
