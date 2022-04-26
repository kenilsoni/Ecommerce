import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './site-layout/home/home.component';
import { TitleComponent } from './site-layout/product/Title/title.component';
import { UserProfileComponent } from './site-layout/user-profile/user-profile.component';
import { UserRegisterComponent } from './site-layout/user-register/user-register.component';

const routes: Routes = [
 
  { path:'',redirectTo:'home',pathMatch:'full'},
  {path:'home',component:HomeComponent},
  {path:'register',component:UserRegisterComponent},
  {path:'profile',component:UserProfileComponent}





];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}