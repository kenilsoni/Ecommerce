import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Category } from '../interface/category';
import {environment} from '../../environments/environment'
import { color } from '../interface/color';
import { size } from '../interface/size';
import { product } from '../interface/product';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  //set currency
  public set_currency: BehaviorSubject<string> = new BehaviorSubject<string>("");
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
  getcategory_id(id:any){
    return this.httpclient.get<Category>(`${environment.API_URL}/subcategory/read.php/?cid=`+id)
  }
  // get color & totalcount
  getcolor(id:any){
    return this.httpclient.get<color>(`${environment.API_URL}/color/read.php?cid=`+id)
  }
  // get size & totalcount
  getsize(id:any){
    return this.httpclient.get<size>(`${environment.API_URL}/size/read.php?cid=`+id)
  }
  // get price count
  getprice(){
    return this.httpclient.get<size>(`${environment.API_URL}/product/getprice.php`)
  }
   // get product by name
   getproductby_name(name:string,load_product:number,order:string=''){
    return this.httpclient.get<size>(`${environment.API_URL}/product/read.php?name=`+name+'&limit='+load_product+'&order'+order)
  }
  //get product by category id
  getproductbycat_id(cat_id:any,load_product:number,order:string=''){
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
  all_product_filter(order:any,from:number,to:number,load:number,cat_id:any,subcat_id:any,clr_id:any,size_id:any,name:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/filter.php?from=`+from+'&to='+to+'&load='+load+'&order='+order+'&cat_id='+cat_id+'&clr_id='+clr_id+'&subcat_id='+subcat_id+'&size_id='+size_id+'&name='+name)
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
  add_wishlist(user_id:number,product_id:number,price_id:any){
    return this.httpclient.get<product>(`${environment.API_URL}/wishlist/add.php?user_id=`+user_id+'&product_id='+product_id+'&price_id='+price_id)
  }
  checkout_product(product:any){
    return this.httpclient.post(`${environment.API_URL}/checkout/checkout.php`,product)
  }
  //get slider
  get_slider(){
    return this.httpclient.get(`${environment.API_URL}/slider/slider.php`)
  }
  //get testimonial
  get_testimonial(){
    return this.httpclient.get(`${environment.API_URL}/testimonial/testimonial.php`)
  }
  //set currnecy
  convertWithCurrencyRate(value: number, currency: string) {
    if (currency == 'USD') {
      return value / 100;
    } else if (currency == 'INR') {
      return value;
    } else {
      return value;
    }
  }
  //get coupan
  get_coupan(){
    return this.httpclient.get(`${environment.API_URL}/coupan/coupan.php`)
  }
  get_shipadd(user_id:number){
    return this.httpclient.get(`${environment.API_URL}/tax/tax.php?ship_id=`+user_id)
  }
  //get success order detail
  get_success(cs_id:any){
    return this.httpclient.get(`${environment.API_URL}/checkout/success.php?cs_id=`+cs_id)
  }
  place_order(user_id:any,payment_id:any,total:any){
    return this.httpclient.get(`${environment.API_URL}/checkout/place_order.php?user_id=`+user_id+'&payment_id='+payment_id+'&total='+total)
  }
  //get order history
  get_order_history(load_order:any,user_id:any){
    return this.httpclient.get(`${environment.API_URL}/order/get.php?user_id=`+user_id+'&load='+load_order)
  }
  filter_order_history(load_order:any,user_id:any,status:any,time:any,name:any){
    return this.httpclient.get(`${environment.API_URL}/order/filter.php?status=`+status+'&time='+time+'&name='+name+'&user_id='+user_id+'&load='+load_order)
  }
  //review
  add_review_data(userid:any,pid:any,review:any,rate:any){
    return this.httpclient.get(`${environment.API_URL}/product/add_review.php?userid=`+userid+'&pid='+pid+'&review='+review+'&rate='+rate)
  }
  //review by product id
  get_reviewid(pid:any,load:number){
    return this.httpclient.get(`${environment.API_URL}/product/get_review.php?pid=`+pid+'&load='+load)
  }


}