import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'titlecase'
})
export class TitlecasePipe implements PipeTransform {
  transform(word:string): string {
    if (!word) return word;
    return word[0].toUpperCase() + word.substring(1).toLowerCase();
  }
}
