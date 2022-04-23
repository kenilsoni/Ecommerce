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
  //get product by color id
  getproductbyclr_id(id:number,cid:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/getcolor.php?clr_id=`+id+'&cid='+cid)
  }
   //get product by size id
  getproductbysize_id(id:any,cid:number,load_product:number){
    // console.log(`${environment.API_URL}/product/getsize.php?size_id=`+id+'&cid='+cid)
    return this.httpclient.get<product>(`${environment.API_URL}/product/getsize.php?size_id=`+id+'&cid='+cid+'&limit='+load_product)
  }
  //get order by
  getorderby(order:string,cid:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/orderby.php?order=`+order+'&cid='+cid)
  }
  // get single product
  getproduct_single(id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/getproduct.php?id=`+id)
  }
  //price filter
  price_filter(from:number,to:number,load:number,cid:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cid)
  }
  //get trending product
  gettrend_product(load:number,trend:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/trending.php?load=`+load+'&trend='+trend)
  }
  all_product(sid:any,sizeid:any,cid:number,load:number){
    console.log(`${environment.API_URL}/product/size2.php?limit=`+load+'&cid='+cid+'&sizeid='+sizeid+'&sid='+sid)
    return this.httpclient.get<product>(`${environment.API_URL}/product/size2.php?limit=`+load+'&cid='+cid+'&size_id='+sizeid+'&sid='+sid)
  }
  all_product2(sidarr:any,clrid:any,cid:number,size_arr:any,load:number){
    console.log(`${environment.API_URL}/product/size2.php?limit=`+load+'&cid='+cid+'&clr_id='+clrid+'&sid_arr='+sidarr+'&size_arr='+size_arr)
    return this.httpclient.get<product>(`${environment.API_URL}/product/size2.php?limit=`+load+'&cid='+cid+'&clr_id='+clrid+'&sid_arr='+sidarr+'&size_arr='+size_arr)
  }
  

}