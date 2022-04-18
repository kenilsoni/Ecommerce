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
  id!: number
  data!:any
  color!:any
  size!:any
  price!:any
  ngOnInit(): void {
    this.route.params.subscribe(data => { this.id=data['id']
  
    this.service.getcategory_id(this.id).subscribe(data=>{
      this.data=data['data']
      // console.log(data['data'])
      // console.log(this.id)
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
