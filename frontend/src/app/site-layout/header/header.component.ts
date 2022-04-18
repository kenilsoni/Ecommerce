import { Component, OnInit } from '@angular/core';
import { Category } from '../category';
import { ProductService } from '../../service/product.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {
  categorylist:any;
  subcategorylist:any;
  constructor(private product:ProductService) { }

  ngOnInit(): void {
    this.product.getcategory().subscribe(response=>{
      this.categorylist=response.data;
      console.log(response.data);
    })
    this.product.get_subcategory().subscribe(response=>{
      this.subcategorylist=response.data;
      console.log(response.data);
    })
  }
  

}
