import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-user-register',
  templateUrl: './user-register.component.html',
  styleUrls: ['./user-register.component.css']
})
export class UserRegisterComponent implements OnInit {
  registerval!:FormGroup
  constructor(private formbuilder: FormBuilder) { }

  ngOnInit(): void {
    this.registerval = this.formbuilder.group({
      firstname: ['', [Validators.required,Validators.pattern('^[a-zA-Z]+$')]],
      email: ['', [Validators.required,Validators.email]],
      phone: ['', [Validators.required,Validators.minLength(10),Validators.maxLength(12)]],
      password:['',[Validators.required,Validators.minLength(6)]],
      lastname:['',[Validators.required]]
    })
  
  }
  submituser(){

  }

}
