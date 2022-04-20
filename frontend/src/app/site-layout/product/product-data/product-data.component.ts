import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from 'src/app/service/product.service';

@Component({
  selector: 'app-product-data',
  templateUrl: './product-data.component.html',
  styleUrls: ['./product-data.component.css']
})
export class ProductDataComponent implements OnInit {

  constructor(private product: ProductService, public route: ActivatedRoute) { }
  product_id!:number
  product_details:any=[]

  ngOnInit(): void {
    this.route.params.subscribe(data => {
      this.product_id = data['id'];
    })
    this.getproduct()
    

  }
  getproduct(){
    this.product.getproduct_single(this.product_id).subscribe(data=>{
      this.product_details=data['data']
    })
  }
}
