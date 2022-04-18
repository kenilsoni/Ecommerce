import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from 'src/app/service/product.service';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.css']
})
export class SidebarComponent implements OnInit {

  constructor(private route: ActivatedRoute , private service:ProductService) { }
  cid!: number
  sid!:number
  data!:any
  color!:any
  size!:any
  price!:any
  count!:number
  ngOnInit(): void {
    this.route.params.subscribe(data => { this.cid=data['cid']
  
    this.service.getcategory_id(this.cid).subscribe(data=>{
      this.data=data['data']
      // this.count=data['count']
      // console.log(data['count'])
      // this.service.gettotal_count(this.cid,this.sid).subscribe(data=>{
      //   this.price=data['data']
      //     //  console.log(this.price.min);
      // })
    })

    
  })
  this.service.getcolor().subscribe(data=>{
    this.color=data['data']
    // console.log(data['data'])
  })
  
  this.service.getsize().subscribe(data=>{
    this.size=data['data']
    // console.log(data['data']);
  })

  this.service.getprice().subscribe(data=>{
    this.price=data['data']
      //  console.log(this.price.min);
  })

 

  }
}
