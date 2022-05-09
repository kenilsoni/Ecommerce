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
  // get color & totalcount
  getcolor(id:number){
    return this.httpclient.get<color>(`${environment.API_URL}/color/read.php?cid=`+id)
  }
  // get size & totalcount
  getsize(id:number){
    return this.httpclient.get<size>(`${environment.API_URL}/size/read.php?cid=`+id)
  }
  // get price count
  getprice(){
    return this.httpclient.get<size>(`${environment.API_URL}/product/getprice.php`)
  }
  //get product by category id
  getproductbycat_id(cat_id:number,load_product:number,order:string=''){
    return this.httpclient.get<product>(`${environment.API_URL}/product/read.php?cat_id=`+cat_id+'&limit='+load_product+'&order'+order)
  }
  //get product by subcategory id
  getproductbysubcat_id(subcat_id:any,cat_id:number,load_product:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/read.php?cat_id=`+cat_id+'&subcat_id='+subcat_id+'&limit='+load_product)
  }
  // get single product
  getproduct_single(id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/getproduct.php?id=`+id)
  }
  //get trending product
  gettrend_product(load:number,trend:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/trending.php?load=`+load+'&trend='+trend)
  }
  //all product filter
  all_product_filter(order:any,from:number,to:number,load:number,cat_id:number,subcat_id:any,clr_id:any,size_id:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/filter.php?from=`+from+'&to='+to+'&load='+load+'&order='+order+'&cat_id='+cat_id+'&clr_id='+clr_id+'&subcat_id='+subcat_id+'&size_id='+size_id)
  }
  //get wishlist
  get_wishlist(user_id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/wishlist/get.php?user_id=`+user_id)
  }
  //remove wishlist item
  remove_item(user_id:number,product_id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/wishlist/remove.php?user_id=`+user_id+'&product_id='+product_id)
  }
  //add wishlist
  add_wishlist(user_id:number,product_id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/wishlist/add.php?user_id=`+user_id+'&product_id='+product_id)
  }
  

}