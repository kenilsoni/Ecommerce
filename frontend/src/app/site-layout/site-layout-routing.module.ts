import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { MainComponent } from './product/main/main.component';
import { ProductDataComponent } from './product/product-data/product-data.component';
import { TitleComponent } from './product/Title/title.component';


const routes: Routes = [
    {path:'product/:cname/:cid',component:MainComponent},
    {path:'product/:id',component:ProductDataComponent},
    {path:'product/:cname/:cid/:sname/:sid',component:MainComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class SitelayoutRoutingModule { }
