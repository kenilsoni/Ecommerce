import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'price'
})
export class PricePipe implements PipeTransform {

  transform(value:any): any {
    const resultarray=[]
    if(value.length===0){ return value }
    for(const item of value){
      
    }
  }

}
