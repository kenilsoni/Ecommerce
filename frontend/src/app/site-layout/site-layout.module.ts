import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { HttpClientModule } from '@angular/common/http';
import { ProductService } from '../service/product.service';
import { SitelayoutRoutingModule } from './site-layout-routing.module';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
import { MatSliderModule } from '@angular/material/slider';



@NgModule({
  declarations: [
    HeaderComponent,
    FooterComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    SitelayoutRoutingModule,
    NgxSliderModule,
    MatSliderModule
    
  ],
  exports: [
    HeaderComponent,
    FooterComponent
  ]
})
export class SiteLayoutModule { }
