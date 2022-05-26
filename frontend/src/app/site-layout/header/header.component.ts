import { Component, ElementRef, HostListener, OnInit, QueryList, ViewChild, ViewChildren } from '@angular/core';
import { ProductService } from '../../service/product.service';
import { CartService } from 'src/app/service/cart.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service';
import { environment } from 'src/environments/environment';
import { NgToastService } from 'ng-angular-popup';
import { ActivatedRoute, Router } from '@angular/router';


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
  @ViewChild("otp") otp!: ElementRef
  @ViewChild("forgot") forgot!: ElementRef
  @ViewChild("fgpassword") changepassword!: ElementRef
  categorylist: any;
  subcategorylist: any;
  products: any = []
  grandTotal: any
  loginval!: FormGroup
  change_password!: FormGroup
  forgot_password!: FormGroup
  change_password_forgot!: FormGroup
  check_otp!: FormGroup
  islogin!: boolean
  user_name!: any
  login_error!: boolean
  size_details: any = []
  image_url: string = environment.IMAGE_URL
  final_amount: number = 0;
  //change password purpose
  hide_current: boolean = true;
  hide_newpass: boolean = true;
  hide_cpass: boolean = true;
  @ViewChild("myDropdown") dropdown!: ElementRef
  @ViewChild("currency") currency!: ElementRef
  constructor(private toastr: NgToastService, private product: ProductService, private cartService: CartService, private formbuilder: FormBuilder, public userservice: UserService, private route: Router) { }

  ngOnInit(): void {
    this.getcategory();
    this.getsubcategory();
    this.getcart_data()
    this.is_loogedin()
    this.get_currency()
    this.loginval = this.formbuilder.group({
      username: ['', [Validators.required]],
      password: ['', [Validators.required, Validators.minLength(6)]],
    })
    this.change_password = this.formbuilder.group({
      user_id: [''],
      password: ['', [Validators.required, Validators.minLength(6)]],
      new_password: ['', [Validators.required, Validators.minLength(6)]],
      cpassword: ['', [Validators.required, Validators.minLength(6)]],
    }, {
      validators: this.mustMatch('new_password', 'cpassword')
    })
    this.forgot_password = this.formbuilder.group({
      email: ['', [Validators.required, Validators.email]]
    })
    this.check_otp = this.formbuilder.group({
      email: ['', [Validators.required, Validators.email]],
      otp: ['', [Validators.required, Validators.minLength(6)]]
    })
    this.change_password_forgot = this.formbuilder.group({
      email: ['', [Validators.required, Validators.email]],
      new_password: ['', [Validators.required, Validators.minLength(6)]],
      cpassword: ['', [Validators.required, Validators.minLength(6)]],
    }, {
      validators: this.mustMatch('new_password', 'cpassword')
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
    if (name['id']) {
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
    this.toastr.success({ detail: 'Success!', summary: 'Product remove successfully!' });
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
    this.changepassword.nativeElement.style.display = "none"
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
    this.toastr.success({ detail: 'Success!', summary: 'Product update successfully!' });
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
  dp_manage: boolean = false
  dp_currency: boolean = false
  @HostListener('document:click')
  clickOutside() {
    if (this.islogin) {
      if (!this.dp_manage) {
        this.dropdown.nativeElement.style.display = "none"
      } else {
        if (this.dp_manage) {
          this.dropdown.nativeElement.style.display = "block"
          this.dp_manage = false
        }
      }
      if (!this.dp_currency) {
        this.currency.nativeElement.style.display = "none"
      }
      else if (this.dp_currency) {
        this.currency.nativeElement.style.display = "block"
        this.dp_currency = false
      }
    } else {
      if (!this.dp_currency) {
        this.currency.nativeElement.style.display = "none"
      }
      else if (this.dp_currency) {
        this.currency.nativeElement.style.display = "block"
        this.dp_currency = false
      }
    }
  }
  manage_dropdown(e: any) {
    this.dp_manage = true
    this.dropdown.nativeElement.style.display = "block"
  }
  close_dropdown() {
    this.dropdown.nativeElement.style.display = "none"
  }
  currency_btn() {
    this.dp_currency = true
    this.currency.nativeElement.style.display = "block"
  }
  currency_dropdown() {
    this.currency.nativeElement.style.display = "none"
  }
  update_password() {
    if (this.change_password.valid) {
      let name = this.userservice.get_user()
      this.change_password.patchValue({
        user_id: name['id']
      })
      this.userservice.update_password(this.change_password.value).subscribe(data => {
        if (data['success']) {
          this.toastr.success({ detail: 'Success!', summary: 'Password change successfully!' });
          document.getElementById('close_cp')?.click()
          this.change_password.reset()
        } else {
          this.login_error = true
          setTimeout(() => {
            this.login_error = false
          }, 4000);
          this.change_password.reset()
        }
      })
    }
  }
  eye_icon_current() {
    this.hide_current = !this.hide_current;
  }
  eye_icon_newpass() {
    this.hide_newpass = !this.hide_newpass;
  }
  eye_icon_cpass() {
    this.hide_cpass = !this.hide_cpass;
  }
  expirationCounter!: string;
  resend_otp!: any
  startTimer(secsToStart: number, email: any): void {
    var start: number = secsToStart;
    var h: number;
    var m: number;
    var s: number;
    var temp: number;
    var timer: any = setInterval(() => {
      h = Math.floor(start / 60 / 60)
      temp = start - h * 60 * 60;
      m = Math.floor(temp / 60);
      temp = temp - m * 60;
      s = temp;
      var hour = h < 10 ? "0" + h : h;
      var minute = m < 10 ? "0" + m : m;
      var second = s < 10 ? "0" + s : s;
      this.expirationCounter = "otp is valid till " + minute + ":" + second;
      if (start <= 0) {
        clearInterval(timer);
        this.expirationCounter = "otp was expired";
        this.resend_otp = email
      }
      start--;
    }, 1000)
  }
  password_forgot() {
    if (this.forgot_password.valid) {
      this.userservice.check_email(this.forgot_password.value.email).subscribe(data => {
        if (data['success']) {
          this.generete_otp(this.forgot_password.value.email)
          this.forgot_password.reset()
          this.forgot_password.controls['email'].setErrors(null)
        } else {
          this.login_error = true
          setTimeout(() => {
            this.login_error = false
          }, 4000);
        }
      })
    }
  }
  generete_otp(email: any) {
    this.resend_otp = ''
    this.userservice.generate_otp(email).subscribe(res => {
      if (res['message']) {
        this.check_otp.patchValue({ email: email })
        this.otp.nativeElement.style.display = 'block'
        this.forgot.nativeElement.style.display = 'none'
        this.startTimer(environment.SET_TIME_FORGOT, email);
      }
    })
  }
  close_otp() {
    this.otp.nativeElement.style.display = 'none'
  }
  submit_otp() {
    if (this.check_otp.valid) {
      this.userservice.check_otp(this.check_otp.value.email, this.check_otp.value.otp).subscribe(res => {
        if (res['message']) {
          this.changepassword.nativeElement.style.display = 'block'
          this.otp.nativeElement.style.display = 'none'
          this.change_password_forgot.patchValue({ email: this.check_otp.value.email })
          this.check_otp.reset()
          this.check_otp.controls['otp'].setErrors(null)
          this.check_otp.controls['email'].setErrors(null)
        } else {
          this.check_otp.controls['otp'].setErrors({ 'wrong_otp': true });
        }
      })
    }
  }
  change_fgpassword() {
    if (this.change_password_forgot.valid) {
      this.userservice.update_fgpassword(this.change_password_forgot.value.email, this.change_password_forgot.value.cpassword).subscribe(res => {
        if (res['message']) {
          this.changepassword.nativeElement.style.display = 'none'
          this.change_password_forgot.reset()
          this.change_password_forgot.controls['new_password'].setErrors(null)
          this.change_password_forgot.controls['cpassword'].setErrors(null)
          this.change_password_forgot.controls['email'].setErrors(null)
          this.toastr.success({ detail: 'Success!', summary: 'Password change successfully!' });
        } else {
          this.toastr.success({ detail: 'Error!', summary: 'Something went wrong!' });
        }
      })
    }
  }
  mustMatch(controlName: string, matchingControlName: string) {
    return (formGroup: FormGroup) => {
      const control = formGroup.controls[controlName];
      const matchingControl = formGroup.controls[matchingControlName];
      if (matchingControl.errors && !matchingControl.errors['mustMatch']) {
        return;
      }
      // set error on matchingControl if validation fails
      if (control.value !== matchingControl.value) {
        matchingControl.setErrors({ mustMatch: true });
      } else {
        matchingControl.setErrors(null);
      }
      return null;
    };
  }
  INR_convert() {
    this.product.set_currency.next('INR')
  }
  USD_convert() {
    this.product.set_currency.next('USD')
  }
  selectedCurrency: any
  get_currency() {
    this.product.set_currency.subscribe(data => {
      if (data.length > 0) {
        this.selectedCurrency = data
      } else {
        this.selectedCurrency = 'INR'
      }
    })
  }
  convertWithCurrencyRate(value: number, currency: string) {
    return this.product.convertWithCurrencyRate(value, currency)
  }
  global_search(e: any) {
    this.route.navigate(['/search/' + e.value + '']);
  }
}
