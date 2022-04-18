import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TitleComponent } from './Title/title.component';
import { SidebarComponent } from './sidebar/sidebar.component';
import { MainComponent } from './main/main.component';



@NgModule({
  declarations: [
    TitleComponent,
    SidebarComponent,
    MainComponent
  ],
  imports: [
    CommonModule
  ],
  exports:[
    MainComponent

  ]
})
export class ProductModule { }
