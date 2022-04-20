import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TitleComponent } from './Title/title.component';
import { MainComponent } from './main/main.component';
import { ProductDetailsComponent } from './product-details/product-details.component';
import { SitelayoutRoutingModule } from '../site-layout-routing.module';
import { MatSliderModule } from '@angular/material/slider';
import { FormsModule } from '@angular/forms';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
import { ProductDataComponent } from './product-data/product-data.component';



@NgModule({
  declarations: [
    TitleComponent,
    MainComponent,
    ProductDetailsComponent,
    ProductDataComponent
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
    TitleComponent,
    ProductDataComponent

  ]
})
export class ProductModule { }
