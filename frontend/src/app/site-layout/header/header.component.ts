import { AfterViewInit, Component, ElementRef, OnInit, QueryList, ViewChild, ViewChildren } from '@angular/core';
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


export class HeaderComponent implements OnInit,AfterViewInit {
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
  size_details:any=[]
  image_url: string = environment.IMAGE_URL
  constructor(private product: ProductService, private cartService: CartService, private formbuilder: FormBuilder, private userservice: UserService) { }
  ngAfterViewInit(): void {
    this.hide_dropdown()
    // this.hide_text()

  }

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
  edit_product(id: number) {
    // console.log(id)
    // console.log(cid)
    // console.log(sid)
   
    this.get_size(id)
    this.display_dropdownid(id)
    this.hide_textid(id)
    this.quantity.forEach((element)=>{
     if(id==element.nativeElement.id){
       let value=element.nativeElement.innerHTML
      this.quantity_text.forEach((element)=>{
        if(id==element.nativeElement.id){
        element.nativeElement.value=value
        }
      })
    }
  })
    // this.hide_dropdownid(id)
  }
 
  get_size(id: number) {
    this.cartService.getsizeby_id(id).subscribe(data => {
      this.size_details = data
    })
  }
 
  update_cart(id:number) {
    this.hide_dropdownid(id)
    this.display_textid(id)
    // this.products.forEach((element: any) => {
    //   element.final_amount=this.final_amount

    // });
    this.cartService.update_product(this.products)
    this.getcart_data()
    // console.log(this.products)
  }
  hide_dropdown() {
   
    this.size_change.forEach((element) => {
      element.nativeElement.style.display = 'none';
    })
    this.quantity_text.forEach((element) => {
      element.nativeElement.style.display = 'none';
    })
    this.update.forEach((element) => {
      element.nativeElement.style.display = 'none';
    })
  }
  display_dropdown() {
 
    this.size_change.forEach((element) => {
      element.nativeElement.style.display = 'block';
    })
    this.quantity_text.forEach((element) => {
      element.nativeElement.hidden = true;
    })
   
  }
  hide_text() {
   
    this.size_text.forEach((element) => {
      element.nativeElement.hidden = true;
    })
    this.quantity.forEach((element) => {
      element.nativeElement.hidden = true;
    })
   
  }
  display_text() {
 
    this.size_text.forEach((element) => {
      element.nativeElement.hidden = false;
    })
      this.quantity.forEach((element) => {
        element.nativeElement.hidden = false;
      })
  }
  //by id
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
      // console.log(id)
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
        let myArray = element.nativeElement.value.split(",");
        // let assign_size = myArray[0]
        this.size_text.forEach((element) => {
          if (e.target.id == element.nativeElement.id) {
            this.products.forEach((element: any) => {
             
              element.Size_Name =myArray[0]
              element.Size_id =myArray[1]
            });
            // element.nativeElement.innerHTML = assign_size
          }
        })
      }
    })
  }
  change_quantity(e: any){
    this.quantity_text.forEach((element)=>{
      if (e.target.id == element.nativeElement.id) {
      
        // let assign_size = myArray[0]
          let qty=element.nativeElement.value
          if (e.target.id == element.nativeElement.id) {
            this.products.forEach((element: any) => {
              if(element.ID==e.target.id){
              element.Product_Quantity =qty
              }
            });
          }
     
      }
    })
  }

}
