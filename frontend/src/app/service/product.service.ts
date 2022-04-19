import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Category } from '../site-layout/interface/category';
import {environment} from '../../environments/environment'
import { color } from '../site-layout/interface/color';
import { size } from '../site-layout/interface/size';
import { product } from '../site-layout/interface/product';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  constructor(private httpclient:HttpClient) { }
  // getcategory
  getcategory(){
    return this.httpclient.get<Category>(`${environment.API_URL}/category/read.php`)
  }
  // get subcategory
  get_subcategory(){
    return this.httpclient.get<Category>(`${environment.API_URL}/subcategory/read.php`)
  }
   // get subcategory and totalcount
  getcategory_id(id:number){
    return this.httpclient.get<Category>(`${environment.API_URL}/subcategory/read.php/?cid=`+id)
  }
  // get color
  getcolor(){
    return this.httpclient.get<color>(`${environment.API_URL}/color/read.php`)
  }
  // get size
  getsize(){
    return this.httpclient.get<size>(`${environment.API_URL}/size/read.php`)
  }
  // get price count
  getprice(){
    return this.httpclient.get<size>(`${environment.API_URL}/product/getprice.php`)
  }
  //get product by category id
  getproductbycat_id(cat_id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/read.php?cat_id=`+cat_id)
  }
  //get product by subcategory id
  getproductbysubcat_id(subcat_id:number,cat_id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/read.php?cat_id=`+cat_id+'&subcat_id='+subcat_id)
  }
  //get product by color id
  getproductbyclr_id(id:number,cid:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/getcolor.php?clr_id=`+id+'&cid='+cid)
  }
   //get product by size id
  getproductbysize_id(id:number,cid:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/getsize.php?size_id=`+id+'&cid='+cid)
  }
  

}