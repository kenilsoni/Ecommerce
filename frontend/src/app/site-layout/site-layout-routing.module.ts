import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { MainComponent } from './product/main/main.component';
import { TitleComponent } from './product/Title/title.component';


const routes: Routes = [
    {path:'product/:name/:id',component:MainComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class SitelayoutRoutingModule { }
