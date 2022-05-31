import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service';
import { NgToastService } from 'ng-angular-popup';
@Component({
  selector: 'app-contact-us',
  templateUrl: './contact-us.component.html',
  styleUrls: ['./contact-us.component.css']
})
export class ContactUsComponent implements OnInit {
  contact_form!:FormGroup
  
  constructor(private toastr: NgToastService,private formbuilder: FormBuilder, private userservice: UserService) { }

  ngOnInit(): void {
    this.contact_form = this.formbuilder.group({
      name: ['',[Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      message: ['', [Validators.required]],
      subject: ['', [Validators.required]],
    })
  }
  add_contact(){
    if(this.contact_form.valid){
      this.userservice.add_contact(this.contact_form.value).subscribe(data=>{
        if(data['message']){
          this.toastr.success({detail:'Success!', summary:'Mail Sent successfully!'});
          this.contact_form.reset()
          this.contact_form.controls['name'].setErrors(null)
          this.contact_form.controls['email'].setErrors(null)
          this.contact_form.controls['message'].setErrors(null)
          this.contact_form.controls['subject'].setErrors(null)
        }else{
          this.toastr.error({detail:'Error!', summary:'Mail was not sent!'});
        }
      })
    }
  }

}
