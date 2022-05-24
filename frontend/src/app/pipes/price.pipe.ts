import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'price'
})
export class PricePipe implements PipeTransform {

  transform(value:any,currency:any): any {
    if (currency == 'USD') {
      return value / 100;
    } else if (currency == 'INR') {
      return value;
    } else {
      return value;
    }
  }

}
