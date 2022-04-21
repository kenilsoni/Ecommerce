import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AboutComponent } from './about/about.component';
import { ContactUsComponent } from './contact-us/contact-us.component';
import { CartComponent } from './product/cart/cart.component';
import { MainComponent } from './product/main/main.component';
import { ProductDataComponent } from './product/product-data/product-data.component';
import { TitleComponent } from './product/Title/title.component';
import { UserRegisterComponent } from './user-register/user-register.component';


const routes: Routes = [
    {path:'product/:cname/:cid',component:MainComponent},
    {path:'product/:id',component:ProductDataComponent},
    {path:'product/:cname/:cid/:sname/:sid',component:MainComponent},
    {path:'home/about',component:AboutComponent},
    {path:'home/contactus',component:ContactUsComponent},
    {path:'home/registration',component:UserRegisterComponent},
    {path:'cart',component:CartComponent}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class SitelayoutRoutingModule { }
