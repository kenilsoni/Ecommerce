import { asNativeElements, Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service';
import { NgToastService } from 'ng-angular-popup';
@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit{
  profileval!:FormGroup
  user_id!:any
  user_details:any=[]
  email_exist!:boolean
  username_exist!:boolean
  update!:boolean
  country_bill:any=[]
  city_bill:any=[]
  state_bill:any=[]
  country_ship:any=[]
  city_ship:any=[]
  state_ship:any=[]
  city_disable:boolean=true
  address_billing:any=[]
  address_shipping:any=[]


  @ViewChild("city_check") city_check!: ElementRef;
  @ViewChild("state_check") state_check!: ElementRef;
  @ViewChild("country_check") country_check!: ElementRef;
  @ViewChild("street_check") street_check!: ElementRef;
  @ViewChild("sameas") sameas!: ElementRef;
  constructor(private toastr: NgToastService,private formbuilder: FormBuilder,private userservice:UserService) { 
    this.get_user()
    this.get_country()
  }
  ngOnInit(): void {
    this.profileval = this.formbuilder.group({
      id: [''],
      username: ['',[Validators.required]],
      password: ['', [Validators.required, Validators.minLength(6)]],
      email: ['', [Validators.required, Validators.email]],
      firstname: ['', [Validators.required,Validators.pattern('[a-zA-Z]*')]],
      lastname: ['', [Validators.required,Validators.pattern('[a-zA-Z]*')]],
      mobile: ['', [Validators.required, Validators.pattern('[0-9\/]*'),Validators.maxLength(12),Validators.minLength(10)]],
      gender: ['', [Validators.required]],
      billing:this.formbuilder.group({
        street_bill:[''],
        country_bill:[''],
        state_bill:[''],
        city_bill:[''],
      }),
      shipping:this.formbuilder.group({
        street_ship:[''],
        country_ship:[''],
        state_ship:[''],
        city_ship:[''],
      }),
      phone: ['', [Validators.required, Validators.pattern('[0-9\/]*'),Validators.maxLength(12),Validators.minLength(10)]],
    })
  }
  get_user(){
    this.user_id=this.userservice.get_user()
    this.userservice.get_userdetails(this.user_id['id']).subscribe(res=>{
      if(res['success']){
        this.user_details=res['user_data']
        this.address_shipping=res['address_shipping']
        this.address_billing=res['address_billing']
        this.set_details()
      }
    })
  }
  set_details(){
    this.profileval.patchValue({
      id:this.user_id['id'],
      firstname: this.user_details['FirstName'],
      lastname: this.user_details['LastName'],
      username:this.user_details['UserName'],
      password:this.user_details['Password'],
      email:this.user_details['Email'],
      mobile:this.user_details['Mobile'],
      gender:this.user_details['Gender'],
      phone:this.user_details['Phone'],
   });   
   this.setaddress_bill()
   this.setaddress_ship()
  }
  setaddress_bill(){
    if(this.address_billing.length!=0){
      this.getstateby_id(this.address_billing['Country_ID']);
      this.getcityby_id(this.address_billing['State_ID']);
      this.profileval.patchValue({
        billing:{
          street_bill:this.address_billing['Street'],
          country_bill:this.address_billing['Country_ID'],
          state_bill:this.address_billing['State_ID'],
          city_bill:this.address_billing['City_ID'],
        }
      })
    } 
  }
  getstateby_id(id:number){
    this.userservice.get_state(id).subscribe(res=>{
      this.state_bill=res['data']
    })
  }
  getcityby_id(id:number){
    this.userservice.get_city(id).subscribe(res=>{
      this.city_bill=res['data']
    })
  }
  getstateby_id_ship(id:number){
    this.userservice.get_state(id).subscribe(res=>{
      this.state_ship=res['data']
    })
  }
  getcityby_id_ship(id:number){
    this.userservice.get_city(id).subscribe(res=>{
      this.city_ship=res['data']
    })
  }
  setaddress_ship(){    
    if(this.address_shipping.length!=0){
      this.getcityby_id_ship(this.address_shipping['State_ID'])
      this.getstateby_id_ship(this.address_shipping['Country_ID'])
    this.profileval.patchValue({
      shipping:{
        street_ship:this.address_shipping['Street'],
        country_ship:this.address_shipping['Country_ID'],
        state_ship:this.address_shipping['State_ID'],
        city_ship:this.address_shipping['City_ID'],
      }
    })
  }
  }
  check_username(e:any){
    console.log(e.target.value)
    if(this.user_details['UserName'] !== e.target.value ){
    this.userservice.check_username(e.target.value).subscribe(res=>{
      if(res['success']){
        this.username_exist=true
        this.profileval.controls['username'].setErrors({'incorrect': true});
      }else{
        this.username_exist=false
      }
    })
  }
  }
  check_email(e:any){
    if(this.user_details['Email'] !== e.target.value ){
      this.userservice.check_email(e.target.value).subscribe(res=>{
        if(res['success']){
          this.email_exist=true
          this.profileval.controls['email'].setErrors({'incorrect': true});
        }else{
          this.email_exist=false
        }
      })
    }
  }
  get_country(){
    this.userservice.get_country().subscribe(res=>{
      this.country_bill=res['data']
      this.country_ship=res['data']
    })
  }
  get_state_bill(e:any){
    this.getstateby_id(e.target.value)
  this.sameas.nativeElement.checked=false
  }
  get_city_bill(e:any){
    this.getcityby_id(e.target.value)
  this.sameas.nativeElement.checked=false
  }
   get_state_ship(e:any){
     this.getstateby_id_ship(e.target.value)
   this.sameas.nativeElement.checked=false
  }
  get_city_ship(e:any){
    this.getcityby_id_ship(e.target.value)
  this.sameas.nativeElement.checked=false
  }
  sameas_checkbox(e:any){
    if(e.target.checked){
      if(this.country_check.nativeElement.value !== ''){
        this.getcityby_id(this.state_check.nativeElement.value)
        this.getstateby_id(this.country_check.nativeElement.value)
        this.profileval.patchValue({
          billing:{
            street_bill:this.street_check.nativeElement.value,
            country_bill:this.country_check.nativeElement.value,
            state_bill:this.state_check.nativeElement.value,
            city_bill:this.city_check.nativeElement.value,
          }
        })
      }  
    }
  }
  uncheck_sameas(){
    this.sameas.nativeElement.checked=false
  }
  submituser(){
    if(this.profileval.valid){
      this.userservice.update_user(this.profileval.value).subscribe(res=>{
        if(res['success']){
          this.update=true
          this.toastr.success({detail:'Success!', summary:'Profile updated successfully!'});
        }else{
          this.update=false
          this.toastr.error({detail:'Error!', summary:'Product is not updated!'});
        }
      })
    }
  }
}
