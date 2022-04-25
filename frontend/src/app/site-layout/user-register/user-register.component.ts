import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-user-register',
  templateUrl: './user-register.component.html',
  styleUrls: ['./user-register.component.css']
})
export class UserRegisterComponent implements OnInit {
  registerval!:FormGroup
  register!:boolean
  username_exist!:boolean
  email_exist!:boolean
  constructor(private formbuilder: FormBuilder,private userservice:UserService) { }

  ngOnInit(): void {
    this.registerval = this.formbuilder.group({
        username: ['',[Validators.required]],
        password: ['', [Validators.required, Validators.minLength(6)]],
        email: ['', [Validators.required, Validators.email]],
        firstname: ['', [Validators.required,Validators.pattern('[a-zA-Z]*')]],
        lastname: ['', [Validators.required,Validators.pattern('[a-zA-Z]*')]],
        mobile: ['', [Validators.required, Validators.pattern('[0-9\/]*'),Validators.maxLength(12),Validators.minLength(10)]],
        gender: ['', [Validators.required]],
        intrest:[''],
        phone: ['', [Validators.required, Validators.pattern('[0-9\/]*'),Validators.maxLength(12),Validators.minLength(10)]]
    })
  
  }
  get username(){
    return this.registerval.get('username')
  }
  get password(){
    return this.registerval.get('password')
  }
  get firstname(){
    return this.registerval.get('firstname')
  }
  get lastname(){
    return this.registerval.get('lastname')
  }
  get phone(){
    return this.registerval.get('phone')
  }
  get email(){
    return this.registerval.get('email')
  }
  get mobile(){
    return this.registerval.get('mobile')
  }
  get gender(){
    return this.registerval.get('gender')
  }
  submituser(){
    if(this.registerval.valid){
      this.userservice.save_user(this.registerval.value).subscribe(res=>{
        if(res['success']){
          this.register=true
          this.form_reset()
        }else{
          this.register=false
        }
      })
    }
  }
  form_reset(){
    this.registerval.reset()
  }
  check_username(e:any){
    console.log(e.target.value)
    this.userservice.check_username(e.target.value).subscribe(res=>{
      if(res['success']){
        this.username_exist=true
        this.registerval.controls['username'].setErrors({'incorrect': true});
      }else{
        this.username_exist=false
      }
    })

  }
  check_email(e:any){
    this.userservice.check_email(e.target.value).subscribe(res=>{
      if(res['success']){
        this.email_exist=true
        this.registerval.controls['email'].setErrors({'incorrect': true});
      }else{
        this.email_exist=false
      }
    })
  }

}
