import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './interceptor/auth.guard';
import { AboutComponent } from './site-layout/about/about.component';
import { ContactUsComponent } from './site-layout/contact-us/contact-us.component';
import { HomeComponent } from './site-layout/home/home.component';
import { CartComponent } from './site-layout/product/cart/cart.component';
import { OrderStatusComponent } from './site-layout/order-status/order-status.component';
import { CoupanComponent } from './site-layout/product/coupan/coupan.component';
import { MainComponent } from './site-layout/product/main/main.component';
import { ProductDataComponent } from './site-layout/product/product-data/product-data.component';
import { TitleComponent } from './site-layout/product/Title/title.component';
import { WishlistComponent } from './site-layout/product/wishlist/wishlist.component';
import { UserProfileComponent } from './site-layout/user-profile/user-profile.component';
import { UserRegisterComponent } from './site-layout/user-register/user-register.component';

const routes: Routes = [
 
  { path:'',redirectTo:'home',pathMatch:'full'},
  {path:'home',component:HomeComponent},
  {path:'register',component:UserRegisterComponent},
  {path:'profile',component:UserProfileComponent,canActivate:[AuthGuard]},
  {path:'product/:cname/:cid',component:MainComponent},
  {path:'product/:id',component:ProductDataComponent},
  {path:'product/:cname/:cid/:sname/:sid',component:MainComponent},
  {path:'home/about',component:AboutComponent},
  {path:'home/contactus',component:ContactUsComponent},
  {path:'home/registration',component:UserRegisterComponent},
  {path:'cart',component:CartComponent,canActivate:[AuthGuard]},
  {path:'wishlist',component:WishlistComponent},
  {path:'coupan',component:CoupanComponent,canActivate:[AuthGuard]},
  {path:'status/:id',component:OrderStatusComponent,canActivate:[AuthGuard]}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}