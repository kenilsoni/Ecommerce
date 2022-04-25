import { Component, OnInit } from '@angular/core';
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
  products:any=[]
  grandTotal:any
  loginval!:FormGroup
  constructor(private product: ProductService,private cartService:CartService,private formbuilder: FormBuilder,private userservice:UserService) { }

  ngOnInit(): void {
    this.getcategory();
    this.getsubcategory();
    this.getcart_data()
    this.loginval = this.formbuilder.group({
      username: ['',[Validators.required]],
      password: ['', [Validators.required, Validators.minLength(6)]],
  })
  }
  getcart_data(){
    this.cartService.getProducts()
    .subscribe(res=>{
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
    })
  }
  getcategory() {
    this.product.getcategory().subscribe(response => {
      this.categorylist = response.data;
      // console.log(response.data);
    })
  }
  getsubcategory() {
    this.product.get_subcategory().subscribe(response => {
      this.subcategorylist = response.data;
      // console.log(response.data);
    })
  }
  removeItem(item: any){
    this.cartService.removeCartItem(item);
  }
  get username(){
    return this.loginval.get('username')
  }
  get password(){
    return this.loginval.get('password')
  }
  login(){
    this.userservice.check_login(this.loginval.value.username,this.loginval.value.password).subscribe(data=>{
      if(data['success']){
        // localStorage.setItem("name",data['name'])
      }
    })
    // console.log(this.loginval.value.password)
  }


}
