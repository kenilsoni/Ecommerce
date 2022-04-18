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

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    TitlecasePipe
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    SiteLayoutModule,
    HttpClientModule,
    ProductModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
