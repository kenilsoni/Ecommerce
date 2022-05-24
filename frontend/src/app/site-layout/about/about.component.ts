import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.css']
})
export class AboutComponent implements OnInit {
  about_data:any=[]
  constructor(public userservice:UserService) { }

  ngOnInit(): void {
    this.get_about()
  }
  get_about(){
    this.userservice.get_about().subscribe(data=>{
      if(data['success']){
        this.about_data=data['success'][0].data;
      }
    })
  }

}
