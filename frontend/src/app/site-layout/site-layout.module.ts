import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { HttpClientModule } from '@angular/common/http';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
import { AboutComponent } from './about/about.component';
import { ContactUsComponent } from './contact-us/contact-us.component';
import { UserRegisterComponent } from './user-register/user-register.component';
import { CartComponent } from './product/cart/cart.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { AppRoutingModule } from '../app-routing.module';
import { OrderStatusComponent } from './order-status/order-status.component';
import {MatProgressBarModule} from '@angular/material/progress-bar';
import { OrderDetailsComponent } from './order-details/order-details.component';
import {MatProgressSpinnerModule} from '@angular/material/progress-spinner';

@NgModule({
  declarations: [
    HeaderComponent,
    FooterComponent,
    AboutComponent,
    ContactUsComponent,
    UserRegisterComponent,
    UserProfileComponent,
    OrderStatusComponent,
    OrderDetailsComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    NgxSliderModule,
    FormsModule,
    ReactiveFormsModule,
    AppRoutingModule,
    MatProgressBarModule,
    MatProgressSpinnerModule

  ],
  exports: [
    HeaderComponent,
    FooterComponent
  ]
})
export class SiteLayoutModule { }
