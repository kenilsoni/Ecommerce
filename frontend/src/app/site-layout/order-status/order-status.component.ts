import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { CartService } from 'src/app/service/cart.service';
import { ProductService } from 'src/app/service/product.service';
import { NgToastService } from 'ng-angular-popup';
@Component({
  selector: 'app-order-status',
  templateUrl: './order-status.component.html',
  styleUrls: ['./order-status.component.css']
})
export class OrderStatusComponent implements OnInit {

  constructor(private toastr: NgToastService,private route:ActivatedRoute,private productservice:ProductService,private cartservice:CartService) { }
  checkout_id:any
  order!:boolean
  order_id:any
  order_fail!:boolean
  order_detail:any=[]
  user_id!:number
  ngOnInit(): void {  
  this.get_csid()
  }
  get_csid(){
    this.route.params.subscribe(data=>{ this.checkout_id=data['id'] 
    this.get_payment_detail()
    })
    let data=this.cartservice.get_id()
    this.user_id=data['id']
  }
  get_payment_detail(){
    if(this.checkout_id.length>5){
      this.productservice.get_success(this.checkout_id).subscribe((data:any)=>{
        if(data){
          this.order_detail=data
          this.addto_db()
          this.order=true
        }else{
          this.order_fail=true
        }
      })
    }else if(this.checkout_id=='false'){
      this.order_fail=true
    }else{
      this.order_fail=true
    }
  }
  addto_db(){
    let total=(this.order_detail.amount_total)/100
    let pid=this.order_detail.payment_intent
    this.productservice.addto_db_product(this.user_id,pid,total).subscribe((res:any)=>{
      if(res){
        this.order_id=res[0]['order_id']
        this.toastr.success({detail:'Success!', summary:'Order Placed successfully!'});
        this.empty_cart()
      }
    })
  }
  empty_cart(){
    this.cartservice.removeAllCart(this.user_id).subscribe();
  }
  
}
