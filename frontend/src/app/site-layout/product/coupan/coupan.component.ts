import { Component, OnInit } from '@angular/core';
import { ProductService } from 'src/app/service/product.service';

@Component({
  selector: 'app-coupan',
  templateUrl: './coupan.component.html',
  styleUrls: ['./coupan.component.css']
})
export class CoupanComponent implements OnInit {

  constructor(private productservice:ProductService) { }

  available:Array<{discount:string,expiry:string,ID:number}>=[]
  expire:Array<{discount:string,expiry:string,ID:number}>=[]

  ngOnInit(): void {
    this.get_coupan()
  }
  get_coupan(){
    this.productservice.get_coupan().subscribe((data:any)=>{
      if(data){
        this.available=data['available']
        this.expire=data['expiry']
      }else{
        this.available=[]
        this.expire=[]
      }
    })
  }

}
