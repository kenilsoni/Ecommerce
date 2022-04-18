import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './site-layout/home/home.component';
import { TitleComponent } from './site-layout/product/Title/title.component';

const routes: Routes = [
 
  { path:'',redirectTo:'home',pathMatch:'full'},
  {path:'home',component:HomeComponent}




];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}