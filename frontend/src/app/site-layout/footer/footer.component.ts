import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgToastService } from 'ng-angular-popup';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent implements OnInit {

  constructor(private toastr: NgToastService,private formbuilder: FormBuilder,private userservice: UserService) { }
  isShow!: boolean
  year!: number
  isSubscribe: boolean = false
  email_exist: boolean = false
  checkinput!:FormGroup
  ngOnInit(): void {
    this.getuser_id()
    this.year = this.currentYearLong()
    this.checkinput = this.formbuilder.group({
      email: ['',[Validators.required,Validators.email]]
    })
  }
  getuser_id() {
    let user = this.userservice.get_user()
    if (user['id']) {
      this.isShow = false
    } else {
      this.isShow = true
    }
  }
  currentYearLong(): number {
    return new Date().getFullYear();
  }
  subscribe(){
    if(this.checkinput.valid){
      this.userservice.checkEmail_nl(this.checkinput.value.email).subscribe(data=>{
        if(data['success']){
          this.email_exist=true
          setTimeout(() => {
            this.email_exist=false
          }, 4000);
        }else{
          this.add_email(this.checkinput.value.email)
        }
      })
    }
  }
  add_email(email:any){
    this.userservice.addEmail_nl(email).subscribe(data=>{
      if(data['success']){
        this.isSubscribe=true
        setTimeout(() => {
          this.isSubscribe=false
        }, 4000);
        this.checkinput.reset()
        this.checkinput.controls['email'].setErrors(null)
        this.toastr.success({detail:'Success!', summary:'Thankyou For Subscription!'});
      }else{
        this.toastr.error({detail:'Error!', summary:'Something went wrong!'});
      }
    })
  }
}
