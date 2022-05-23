import { Component, ElementRef, OnInit, QueryList, ViewChildren } from '@angular/core';
import { ProductService } from 'src/app/service/product.service';
import { UserService } from 'src/app/service/user.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-order-details',
  templateUrl: './order-details.component.html',
  styleUrls: ['./order-details.component.css']
})
export class OrderDetailsComponent implements OnInit {
  user_id!: number
  load_order:number=4
  order_details: any = []
  name_details: any = []
  time_arr:any=[]
  status_arr:any=[]
  search_arr!:string
  @ViewChildren("status")
  status!: QueryList<ElementRef>; 
  @ViewChildren("search")
  search!: QueryList<ElementRef>; 
   @ViewChildren("time")
   time!: QueryList<ElementRef>;
  constructor(private productservice: ProductService, private userservice: UserService) { }
  image_url: string = environment.IMAGE_URL
  ngOnInit(): void {
    this.get_userid()
    this.get_detail()
  }
  get_detail() {
    this.productservice.get_order_history(this.load_order,this.user_id).subscribe((data: any) => {
      this.order_details=data
      console.log(data)
    })

  }
  get_userid() {
    let name = this.userservice.get_user()
    this.user_id = name['id']
  }
  reset_time(){
    this.time.forEach((element) => {
      element.nativeElement.checked = false;
    });
    this.time_arr = []
    this.allproduct_id()
  }
  reset_status(){
    this.status.forEach((element) => {
      element.nativeElement.checked = false;
    });
    this.status_arr = []
    this.allproduct_id()
  }
  allproduct_id() {
    this.time_arr = []
    this.status_arr = []

    this.status.forEach((element) => {
      if (element.nativeElement.checked) {
        this.status_arr.push(element.nativeElement.value)
      }
    });
    this.time.forEach((element) => {
      if (element.nativeElement.checked) {
        this.time_arr.push(element.nativeElement.value)
      }
    });
    this.search.forEach((element) => {
     this.search_arr=element.nativeElement.value;
    });
    console.log(this.time_arr)
    console.log(this.status_arr)
    console.log(this.search_arr)
    console.log(this.order_details.length)

    this.productservice.filter_order_history(this.load_order,this.user_id,this.status_arr, this.time_arr, this.search_arr).subscribe(data => {
      this.order_details=data
      if (this.initial) {
        this.end = this.order_details.length
        if (this.end - this.initial < 4) {
          this.product_count = false
        }
      }
     console.log(data)
    })
  }
  product_count:boolean=true
  initial:any
  end:any
  loadmore_product(e: number) {
    this.load_order = e + 4;
    this.initial = this.order_details.length
    this.allproduct_id()
  }

}
