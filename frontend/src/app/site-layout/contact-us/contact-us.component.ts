import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-contact-us',
  templateUrl: './contact-us.component.html',
  styleUrls: ['./contact-us.component.css']
})
export class ContactUsComponent implements OnInit {
  contact_form!:FormGroup
  constructor(private formbuilder: FormBuilder, private userservice: UserService) { }

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
          alert("added")
          this.contact_form.reset()
        }else{
          alert("not add")
        }
      })
    }
  }

}
