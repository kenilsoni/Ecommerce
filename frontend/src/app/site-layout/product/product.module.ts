import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TitleComponent } from './Title/title.component';
import { MainComponent } from './main/main.component';
import { ProductDetailsComponent } from './product-list/product-details.component';

import { MatSliderModule } from '@angular/material/slider';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
import { ProductDataComponent } from './product-data/product-data.component';
import { CartComponent } from './cart/cart.component';
import { CarouselModule } from 'ngx-owl-carousel-o';
import { NgImageSliderModule } from 'ng-image-slider';
import { AppRoutingModule } from 'src/app/app-routing.module';
import { WishlistComponent } from './wishlist/wishlist.component';
// import { NgImageSliderModule } from 'ng-image-slider';


@NgModule({
  declarations: [
    TitleComponent,
    MainComponent,
    ProductDetailsComponent,
    ProductDataComponent,
    CartComponent,
    WishlistComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    NgxSliderModule,
    MatSliderModule,
    NgImageSliderModule,
    AppRoutingModule
    
    // CarouselModule
  ],
  exports:[
    MainComponent,
    TitleComponent,
    ProductDataComponent,
    CartComponent

  ]
})
export class ProductModule { }
