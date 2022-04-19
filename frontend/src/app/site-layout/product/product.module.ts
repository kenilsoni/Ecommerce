import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TitleComponent } from './Title/title.component';
import { MainComponent } from './main/main.component';
import { ProductDetailsComponent } from './product-details/product-details.component';
import { SitelayoutRoutingModule } from '../site-layout-routing.module';
import { MatSliderModule } from '@angular/material/slider';
import { FormsModule } from '@angular/forms';
import { NgxSliderModule } from '@angular-slider/ngx-slider';



@NgModule({
  declarations: [
    TitleComponent,
    MainComponent,
    ProductDetailsComponent
  ],
  imports: [
    CommonModule,
    SitelayoutRoutingModule,
    FormsModule,
    NgxSliderModule,
    MatSliderModule
  ],
  exports:[
    MainComponent,
    TitleComponent

  ]
})
export class ProductModule { }
