import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent implements OnInit {

  constructor(private userservice:UserService) { }
  isShow!:boolean
  ngOnInit(): void {
    this.getuser_id()
  }
  getuser_id(){
    let user=this.userservice.get_user()

    if(user['id']){
      this.isShow=false
    }else{
      this.isShow=true
    }
  }

}
