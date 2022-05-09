import { Component, ElementRef, OnInit, QueryList, ViewChild, ViewChildren } from '@angular/core';
import { Category } from '../interface/category';
import { ProductService } from '../../service/product.service';
import { CartService } from 'src/app/service/cart.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service';
import { environment } from 'src/environments/environment';
import { NativeDateAdapter } from '@angular/material/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})


export class HeaderComponent implements OnInit {
  @ViewChildren("quantity") quantity!: QueryList<ElementRef>
  @ViewChildren("quantity_text") quantity_text!: QueryList<ElementRef>
  @ViewChildren("size") size_change!: QueryList<ElementRef>
  @ViewChildren("size_text") size_text!: QueryList<ElementRef>
  @ViewChildren("update") update!: QueryList<ElementRef>
  categorylist: any;
  subcategorylist: any;
  products: any = []
  grandTotal: any
  loginval!: FormGroup
  islogin!: boolean
  user_name!: any
  login_error!: boolean
  size_details: any = []
  image_url: string = environment.IMAGE_URL
  final_amount: number = 0;
  @ViewChild("myDropdown") dropdown!:ElementRef
  constructor(private product: ProductService, private cartService: CartService, private formbuilder: FormBuilder, private userservice: UserService) { }

  ngOnInit(): void {
    this.getcategory();
    this.getsubcategory();
    this.getcart_data()
    this.is_loogedin()
    this.loginval = this.formbuilder.group({
      username: ['', [Validators.required]],
      password: ['', [Validators.required, Validators.minLength(6)]],
    })
  }

  is_loogedin() {
    if (this.userservice.get_user()) {
      let name = this.userservice.get_user()
      if (name['firstName'] !== null) {
        this.islogin = true
        this.user_name = name['firstName']
      } else {
        this.islogin = false
      }
    }
  }
  check_cart() {
    this.getcart_data()
  }
  getcart_data() {
    let name = this.userservice.get_user()
    this.cartService.getProducts(name['id']).subscribe(data => {
      if (data['data']) {
        this.products = data['data'];
        this.final_amount = this.get_total()
        this.grandTotal = this.get_total()
      } else {
        this.products = []
        this.grandTotal = 0
        this.final_amount = 0
      }
    })
  }
  get_total() {
    let grandTotal = 0;
    this.products.map((a: any) => {
      grandTotal += Number(a.Total_Amount);
    })
    return grandTotal;
  }
  getcategory() {
    this.product.getcategory().subscribe(response => {
      this.categorylist = response.data;
    })
  }
  getsubcategory() {
    this.product.get_subcategory().subscribe(response => {
      this.subcategorylist = response.data;
    })
  }
  removeItem(cart_id: number) {
    this.cartService.removeCartItem(cart_id).subscribe();
    this.getcart_data()
    this.getcart_data()
    this.grandTotal = this.get_total()
  }
 
  login() {
    if (this.loginval.valid) {
      this.userservice.check_login(this.loginval.value.username, this.loginval.value.password).subscribe((data) => {
        if (data['success']) {
          this.close_modal()
          this.islogin = true
          this.is_loogedin()
          this.loginval.reset()
          window.location.reload()
        } else {
          this.login_error = true
          setTimeout(() => {
            this.login_error = false
          }, 4000);
        }
      })
    }
  }
  unset_user() {
    this.userservice.unset_user()
    this.islogin = false
    window.location.reload()
  }
  close_modal() {
    document.getElementById('cls')?.click()
    this.loginval.reset()
  }
  edit_product(cart_id: number, Product_ID: number) {
    this.get_size(Product_ID)
    this.display_dropdownid(cart_id)
    this.hide_textid(cart_id)
    this.quantity.forEach((element) => {
      if (cart_id == element.nativeElement.id) {
        let value = element.nativeElement.innerHTML
        this.quantity_text.forEach((element) => {
          if (cart_id == element.nativeElement.id) {
            element.nativeElement.value = value
          }
        })
      }
    })
  }
  get_size(id: number) {
    this.cartService.getsizeby_id(id).subscribe(data => {
      this.size_details = data
    })
  }
  update_cart(id: number) {
    this.hide_dropdownid(id)
    this.display_textid(id)
    this.getcart_data()
  }

  hide_dropdownid(id: number) {

    this.size_change.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'none';
      }
    })
    this.quantity_text.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'none';
      }
    })
    this.update.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'none';
      }
    })
  }
  display_dropdownid(id: number) {

    this.size_change.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'block';
      }
    })
    this.quantity_text.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'block';
      }
    })
    this.update.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'block';
      }
    })
  }
  hide_textid(id: number) {

    this.size_text.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'none';
      }
    })
    this.quantity.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'none';
      }
    })
  }
  display_textid(id: number) {
    this.size_text.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'block';
      }
    })
    this.quantity.forEach((element) => {
      if (id == element.nativeElement.id) {
        element.nativeElement.style.display = 'block';
      }
    })
  }
  change_size(e: any) {
    this.size_change.forEach((element) => {
      if (e.target.id == element.nativeElement.id) {
        let size_id = element.nativeElement.value
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
    this.quantity_text.forEach((element) => {
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
  manage_dropdown(){
    if(this.dropdown.nativeElement.style.display=='block'){
      this.dropdown.nativeElement.style.display="none"
    }else{
      this.dropdown.nativeElement.style.display="block"
    }
    
    // document.getElementById("myDropdown").classList.toggle("show");
  }
  close_dropdown(){
    this.dropdown.nativeElement.style.display="none"
  }

}
