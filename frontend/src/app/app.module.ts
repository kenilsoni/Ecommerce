import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {HttpClientModule} from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SiteLayoutModule } from './site-layout/site-layout.module';
import { ProductModule } from './site-layout/product/product.module';
import { HomeComponent } from './site-layout/home/home.component';
import { HeaderComponent } from './site-layout/header/header.component';
import { TitlecasePipe } from './pipes/titlecase.pipe';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatSliderModule } from '@angular/material/slider';
import { PricePipe } from './pipes/price.pipe';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
import { CartComponent } from './site-layout/product/cart/cart.component';
import { CarouselModule } from 'ngx-owl-carousel-o';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    TitlecasePipe,
    PricePipe

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    SiteLayoutModule,
    HttpClientModule,
    ProductModule,
    CarouselModule,
    // CartComponent,
    // BrowserAnimationsModule,
    NgxSliderModule,
    // MatSliderModule

  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
