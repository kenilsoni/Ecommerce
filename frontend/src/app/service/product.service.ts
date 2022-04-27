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
  getproductbyclr_id(id:number,cid:number,load:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/getcolor.php?clr_id=`+id+'&cid='+cid+'&load='+load)
  }
   //get product by size id
  getproductbysize_id(id:any,cid:number,load_product:number){
    // console.log(`${environment.API_URL}/product/getsize.php?size_id=`+id+'&cid='+cid)
    return this.httpclient.get<product>(`${environment.API_URL}/product/getsize.php?size_id=`+id+'&cid='+cid+'&limit='+load_product)
  }
  //get order by
  getorderby(order:string,cid:number,load:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/orderby.php?order=`+order+'&cid='+cid+'&load='+load)
  }
  //get order by
  order_cat(order:string,load:number,cid:number,subcat_arr:any,size_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/orderby.php?order=`+order+'&cid='+cid+'&load='+load+'&subcat_arr='+subcat_arr+'&size_array='+size_arr)
  }
  //get order by
  order_clr(order:string,load:number,cid:number,subcat_arr:any,clr_id:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/orderby.php?order=`+order+'&cid='+cid+'&load='+load+'&subcat_arr='+subcat_arr+'&clr_id='+clr_id)
  }
  //get order by
  order_size(order:string,load:number,cid:number,subcat_arr:any,clr_id:any,size_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/orderby.php?order=`+order+'&cid='+cid+'&load='+load+'&subcat_arr='+subcat_arr+'&clr_id='+clr_id+'&size_arr='+size_arr)
  }
  // get single product
  getproduct_single(id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/getproduct.php?id=`+id)
  }
  //price filter
  price_filter(from:number,to:number,load:number,cid:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cid)
  }
  //price filter
  price_filter_clr(from:number,to:number,load:number,cat_id:number,subcat_arr:any,clr_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&clr_arr='+clr_arr+'&subcat_arr='+subcat_arr)
  }
  //price filter
  price_filter_oneclr(from:number,to:number,load:number,cat_id:number,clr_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&clr_array='+clr_arr)
  }
  //price filter
  price_filter_size(from:number,to:number,load:number,cat_id:number,subcat_arr:any,clr_arr:any,size_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&clr_arr='+clr_arr+'&subcat_arr='+subcat_arr+'&size_arr='+size_arr)
  }
  //price filter
  price_filter_sizeid(from:number,to:number,load:number,cat_id:number,size_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&size_arr2='+size_arr)
  }
  
  //price filter
  price_filter_cat(from:number,to:number,load:number,cat_id:number,subcat_arr:any,size_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&subcat_arr='+subcat_arr+'&size_array='+size_arr)
  }
  price_filter_subcat(from:number,to:number,load:number,cat_id:number,subcat_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&subcat_arrnew='+subcat_arr)
  }
  // price_filter_check(from:number,to:number,load:number,cat_id:number,size_arr:any){
  //   return this.httpclient.get<product>(`${environment.API_URL}/product/pricefilter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&size_arrnew='+size_arr)
  // }
  //get trending product
  gettrend_product(load:number,trend:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/trending.php?load=`+load+'&trend='+trend)
  }
  all_product(sid:any,sizeid:any,cid:number,load:number){
    console.log(`${environment.API_URL}/product/size2.php?limit=`+load+'&cid='+cid+'&sizeid='+sizeid+'&sid='+sid)
    return this.httpclient.get<product>(`${environment.API_URL}/product/size2.php?limit=`+load+'&cid='+cid+'&size_id='+sizeid+'&sid='+sid)
  }
  all_product_getall(sidarr:any,clrid:any,cid:number,size_arr:any,load:number){
    console.log(`${environment.API_URL}/product/size2.php?limit=`+load+'&cid='+cid+'&clr_id='+clrid+'&sid_arr='+sidarr+'&size_arr='+size_arr)
    return this.httpclient.get<product>(`${environment.API_URL}/product/size2.php?limit=`+load+'&cid='+cid+'&clr_id='+clrid+'&sid_arr='+sidarr+'&size_arr='+size_arr)
  }
  cat_filter_all(from:number,to:number,load:number,cat_id:number,clr_arr:any,size_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/cat_filter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&clr_arr='+clr_arr+'&size_arr='+size_arr)
  }
  cat_filter_clr(from:number,to:number,load:number,cat_id:number,clr_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/cat_filter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&clr_arr='+clr_arr)
  }
  cat_filter_subcat(from:number,to:number,load:number,cat_id:number){
    return this.httpclient.get<product>(`${environment.API_URL}/product/cat_filter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id)
  }
  cat_filter_id(from:number,to:number,load:number,cat_id:number,size_arr:any){
    return this.httpclient.get<product>(`${environment.API_URL}/product/cat_filter.php?from=`+from+'&to='+to+'&load='+load+'&cid='+cat_id+'&size_arr='+size_arr)
  }

  all_product_filter(order:any,from:number,to:number,load:number,cat_id:number,subcat_id:any,clr_id:any,size_id:any){
    console.log(`${environment.API_URL}/product/filter.php?from=`+from+'&to='+to+'&load='+load+'&order='+order+'&cat_id='+cat_id+'&clr_id='+clr_id+'&subcat_id='+subcat_id+'&size_id='+size_id)
    return this.httpclient.get<product>(`${environment.API_URL}/product/filter.php?from=`+from+'&to='+to+'&load='+load+'&order='+order+'&cat_id='+cat_id+'&clr_id='+clr_id+'&subcat_id='+subcat_id+'&size_id='+size_id)
  }
  

}