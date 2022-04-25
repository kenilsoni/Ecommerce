import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { HttpClientModule } from '@angular/common/http';
import { ProductService } from '../service/product.service';
import { SitelayoutRoutingModule } from './site-layout-routing.module';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
// import { MatSliderModule } from '@angular/material/slider';
import { AboutComponent } from './about/about.component';
import { ContactUsComponent } from './contact-us/contact-us.component';
import { UserRegisterComponent } from './user-register/user-register.component';
import { CartComponent } from './product/cart/cart.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
// import { NgImageSliderModule } from 'ng-image-slider';
// import { ProductDataComponent } from './product/product-data/product-data.component';



@NgModule({
  declarations: [
    HeaderComponent,
    FooterComponent,
    AboutComponent,
    ContactUsComponent,
    UserRegisterComponent,
    // ProductDataComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    SitelayoutRoutingModule,
    NgxSliderModule,
    FormsModule,
    ReactiveFormsModule
    
    
  ],
  exports: [
    HeaderComponent,
    FooterComponent
  ]
})
export class SiteLayoutModule { }
