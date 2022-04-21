import { Component, OnInit } from '@angular/core';
import { Category } from '../interface/category';
import { ProductService } from '../../service/product.service';
import { CartService } from 'src/app/service/cart.service';

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
  constructor(private product: ProductService,private cartService:CartService) { }

  ngOnInit(): void {
    this.getcategory();
    this.getsubcategory();
    this.getcart_data()

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


}
