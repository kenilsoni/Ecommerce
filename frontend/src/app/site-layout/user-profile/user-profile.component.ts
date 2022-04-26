import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {
  profileval!:FormGroup
  constructor(private formbuilder: FormBuilder,private userservice:UserService) { }

  ngOnInit(): void {
    // this.profileval = this.formbuilder.group({
  //     username: ['',[Validators.required]],
  //     password: ['', [Validators.required, Validators.minLength(6)]],
  //     email: ['', [Validators.required, Validators.email]],
  //     firstname: ['', [Validators.required,Validators.pattern('[a-zA-Z]*')]],
  //     lastname: ['', [Validators.required,Validators.pattern('[a-zA-Z]*')]],
  //     mobile: ['', [Validators.required, Validators.pattern('[0-9\/]*'),Validators.maxLength(12),Validators.minLength(10)]],
  //     gender: ['', [Validators.required]],
  //     // intrest:[''],
  //     phone: ['', [Validators.required, Validators.pattern('[0-9\/]*'),Validators.maxLength(12),Validators.minLength(10)]]
  // })
  }
  // submituser(){

  // }
 


}
