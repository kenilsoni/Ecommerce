import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from 'src/app/service/product.service';


@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.css']
})
export class ProductDetailsComponent implements OnInit {

  constructor(private product:ProductService,public route:ActivatedRoute) { }
  cat_id!:number
  subcat_id!:number
  data:any
  cat_name!:string
  subcat_name!:string

  ngOnInit(): void {
    this.route.params.subscribe(data => { this.cat_id=data['cid'];
    this.subcat_id=data['sid']
    this.cat_name=data['cname'];
    this.subcat_name=data['sname'];
    this.product.getproductbycat_id(this.cat_id).subscribe(data=>{
      this.data=data['data']

    })
    if(this.subcat_id !== undefined){
    this.product.getproductbysubcat_id(this.subcat_id,this.cat_id).subscribe(data=>{
      this.data=data['data']
      // console.log(data['data'])

    })}
  })
  }

}
