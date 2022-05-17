import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SiteLayoutModule } from './site-layout/site-layout.module';
import { ProductModule } from './site-layout/product/product.module';
import { HomeComponent } from './site-layout/home/home.component';
import { TitlecasePipe } from './pipes/titlecase.pipe';
import { PricePipe } from './pipes/price.pipe';
import { NgImageSliderModule } from 'ng-image-slider';
import { AuthInterceptor } from './interceptor/auth.interceptor';
import { AuthGuard } from './interceptor/auth.guard';
import {NgToastModule} from 'ng-angular-popup';
import {MatProgressBarModule} from '@angular/material/progress-bar';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
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
    NgImageSliderModule,
    NgToastModule,
    MatProgressBarModule,
    BrowserAnimationsModule,
    CarouselModule
 
  ],
  providers: [AuthGuard,{ provide: HTTP_INTERCEPTORS, useClass: AuthInterceptor, multi: true }],
  bootstrap: [AppComponent]
})
export class AppModule { }
