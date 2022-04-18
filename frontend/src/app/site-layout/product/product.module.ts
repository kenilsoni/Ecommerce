import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TitleComponent } from './Title/title.component';
import { SidebarComponent } from './sidebar/sidebar.component';
import { MainComponent } from './main/main.component';
import { ProductDetailsComponent } from './product-details/product-details.component';



@NgModule({
  declarations: [
    TitleComponent,
    SidebarComponent,
    MainComponent,
    ProductDetailsComponent
  ],
  imports: [
    CommonModule
  ],
  exports:[
    MainComponent

  ]
})
export class ProductModule { }
