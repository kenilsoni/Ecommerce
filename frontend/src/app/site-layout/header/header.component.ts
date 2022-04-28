import { Component, ElementRef, OnInit, QueryList, ViewChild, ViewChildren } from '@angular/core';
import { Category } from '../interface/category';
import { ProductService } from '../../service/product.service';
import { CartService } from 'src/app/service/cart.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {
  categorylist: any;
  subcategorylist: any;
  products: any = []
  grandTotal: any
  loginval!: FormGroup
  islogin!: boolean
  user_name!: any
  login_error!: boolean
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
  getcart_data() {
    this.cartService.getProducts()
      .subscribe(res => {
        this.products = res;
        this.grandTotal = this.cartService.getTotalPrice();
      })
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
  removeItem(item: any) {
    this.cartService.removeCartItem(item);
  }
  get username() {
    return this.loginval.get('username')
  }
  get password() {
    return this.loginval.get('password')
  }
  login() {
    if (this.loginval.valid) {
      this.userservice.check_login(this.loginval.value.username, this.loginval.value.password).subscribe((data) => {
        if (data['success']) {
          this.close_modal()
          this.islogin = true
          this.is_loogedin()
          this.loginval.reset()
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
  }
  close_modal() {
    document.getElementById('cls')?.click()
    this.loginval.reset()
  }


}
