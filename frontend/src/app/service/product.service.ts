import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Category } from '../site-layout/category';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  constructor(private httpclient:HttpClient) { }
  getcategory(){
    return this.httpclient.get<Category>("http://localhost/ecommerce/php_api/api/category/read.php")
  }
  get_subcategory(){
    return this.httpclient.get<Category>("http://localhost/ecommerce/php_api/api/subcategory/read.php")
  }

}
