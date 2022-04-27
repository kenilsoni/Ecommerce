import { Component, ElementRef, OnInit, QueryList, ViewChildren } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from 'src/app/service/product.service';
import { Options, LabelType } from "@angular-slider/ngx-slider";
import { SliderComponent } from '@angular-slider/ngx-slider/slider.component';
import { environment } from 'src/environments/environment';
import { CartService } from 'src/app/service/cart.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { OwlOptions } from 'ngx-owl-carousel-o';


@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.css']
})
export class ProductDetailsComponent implements OnInit {
  [x: string]: any;
  sorted_data: any;
  image_url: string = environment.IMAGE_URL
  constructor(private product: ProductService, public route: ActivatedRoute, private cartService: CartService, private formbuilder: FormBuilder) { }
  cat_id!: number
  subcat_id!: number
  productdata: any = []
  cat_name!: string
  cat_data!: any
  subcat_name!: string
  color!: any
  size!: any
  price!: any
  product_id!: any
  color_radio: any
  checkval!: FormGroup
  subcat_arr: any = []
  size_arr: any = []
  check_val: any
  ischeck!: boolean
  load_product = environment.load_product

  @ViewChildren("checkboxes")
  checkboxes!: QueryList<ElementRef>;
  @ViewChildren("checkboxes2")
  checkboxes2!: QueryList<ElementRef>;
  @ViewChildren("getcolorval")
  getcolorval!: QueryList<ElementRef>;

  minValue: number = 0;
  maxValue: number = 0;
  options: Options = {
    floor: 0,
    ceil: 0,

  };

  ngOnInit(): void {
    this.route.params.subscribe(data => {
      this.cat_id = data['cid'];
      this.subcat_id = data['sid']
      this.cat_name = data['cname'];
      this.subcat_name = data['sname'];
      this.getproductby_cat();
      this.getsubcategory();
      this.getcolor();
      this.getsize();
      this.getcount();


    })
  }

  getproductby_cat() {
    this.product.getproductbycat_id(this.cat_id, this.load_product).subscribe(data => {
      this.productdata = data['data']
      if (this.subcat_id !== undefined) {

        this.getproductbysubcat_id();

        // this.product.getcategory_id(this.cat_id).subscribe(data => {
        //   // this.cat_data = data['main']
        //   for(let val of data['main']){
        //     // console.log(val['Subcategory_Name'])
        //     if(this.subcat_name===val['Subcategory_Name']){
        //       this.cat_data=val
        //     }
        //   }
        //   console.log(this.cat_data)

        // })

      }
    })
    // console.log(this.checkBoxValue.ID)
  }
  getproductbysubcat_id() {
    this.product.getproductbysubcat_id(this.subcat_id, this.cat_id, this.load_product).subscribe(data => {
      this.productdata = data['data']
      this.product.getcategory_id(this.cat_id).subscribe(data => {
        this.cat_data = []
        for (let val of data['main']) {
          if (this.subcat_id == val['ID']) {
            this.cat_data.push(val);
            this.ischeck = true
          }
        }
      })
    })
  }
  getcount() {
    this.product.getprice().subscribe(data => {
      // this.price = data['data']
      for (let val of data['data']) {
        this.options = {
          floor: val.min,
          ceil: val.max
        }
        this.maxValue = val.max
        this.minValue = val.min
      }
    })
  }
  getsubcategory() {
    this.product.getcategory_id(this.cat_id).subscribe(data => {
      this.cat_data = data['main']
      // console.log(this.cat_data)
    })
  }
  getsize() {
    this.product.getsize(this.cat_id).subscribe(data => {
      this.size = data['main']
    })
  }
  getcolor() {
    this.product.getcolor(this.cat_id).subscribe(data => {
      this.color = data['main']
    })
  }
  category_filter(e: any) {
    if (e.target.checked) {
      this.subcat_arr.push(e.target.value)
      this.clr_temp = []
      this.getcolorval.forEach((element) => {
        if (element.nativeElement.checked) {
          this.clr_temp.push(element.nativeElement.id)
        }
      });
      console.log(this.clr_temp)

      this.size_temp_arr = []
      this.checkboxes2.forEach((element) => {
        if (element.nativeElement.checked) {
          this.size_temp_arr.push(element.nativeElement.id)
        }
      });



      if (this.slider_arr.length !== 0) {
        if (this.clr_temp.length !== 0) {
          if (this.size_arr.length !== 0) {
            //all
            this.product.price_filter_size(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.clr_temp, this.size_arr).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })
          } else {
            //  cat clr price
            this.product.price_filter_clr(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.clr_temp).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })
          }
        } else {
          // console.log(this.subcat_arr.length !== 0);
          if (this.size_arr.length == 0) {
            //cat price
            // console.log(this.snew_arr.length !== 0);
            this.product.price_filter_subcat(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })



          } else {
            //  size cat price
            this.product.price_filter_cat(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.size_arr).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })
          }

        }

      }
      else {
        //cat
        this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
          this.productdata = data['data']
        })

      }
      // }
      // this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
      //   this.productdata = data['data']
      // })
      // } else {
      //   let index = this.subcat_arr.indexOf(e.target.value);
      //   this.subcat_arr.splice(index, 1);
      //   if (this.subcat_arr.length != 0) {
      //     this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
      //       this.productdata = data['data']
      //     })
      //   }
      //   else {
      //     this.getproductby_cat()
      //   }







      // this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
      //   this.productdata = data['data']
      // })
    } else {
      let index = this.subcat_arr.indexOf(e.target.value);
      this.subcat_arr.splice(index, 1);

      this.clr_temp = []
      this.getcolorval.forEach((element) => {
        if (element.nativeElement.checked) {
          this.clr_temp.push(element.nativeElement.id)
        }
      });
      console.log(this.clr_temp)

      this.size_temp_arr = []
      this.checkboxes2.forEach((element) => {
        if (element.nativeElement.checked) {
          this.size_temp_arr.push(element.nativeElement.id)
        }
      });

      console.log(this.subcat_arr)
      console.log(this.slider_arr)
      console.log(this.size_arr)
     
        if (this.slider_arr.length !== 0) {
          if (this.clr_temp.length !== 0) {
            if (this.size_arr.length !== 0) {
              //all
              this.product.price_filter_size(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.clr_temp, this.size_arr).subscribe(data => {
                if (data['data'] !== undefined) {
                  this.productdata = data['data']
                }
                else {
                  this.productdata = []
                }
              })
            } else {
              //  cat clr price
              this.product.price_filter_clr(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.clr_temp).subscribe(data => {
                if (data['data'] !== undefined) {
                  this.productdata = data['data']
                }
                else {
                  this.productdata = []
                }
              })
            }
          } else {
            // console.log(this.subcat_arr.length !== 0);
            if (this.size_arr.length == 0) {
              //cat price
              // console.log(this.snew_arr.length !== 0);
              this.product.price_filter_subcat(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr).subscribe(data => {
                if (data['data'] !== undefined) {
                  this.productdata = data['data']
                }
                else {
                  this.productdata = []
                }
              })



            } else {
              //  size cat price
              this.product.price_filter_cat(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.size_arr).subscribe(data => {
                if (data['data'] !== undefined) {
                  this.productdata = data['data']
                }
                else {
                  this.productdata = []
                }
              })
            }

          }

        }
        else {
 //cat
 this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
  this.productdata = data['data']
})
        // if (this.clr_temp.length !== 0) {
        //     if (this.size_arr.length !== 0) {
        //       //cat clr size
        //       this.product.price_filter_size(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id,this.clr_temp, this.size_arr).subscribe(data => {
        //         if (data['data'] !== undefined) {
        //           this.productdata = data['data']
        //         }
        //         else {
        //           this.productdata = []
        //         }
        //       })
        //     } else {
        //       //  cat clr price
        //       this.product.price_filter_clr(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.clr_temp).subscribe(data => {
        //         if (data['data'] !== undefined) {
        //           this.productdata = data['data']
        //         }
        //         else {
        //           this.productdata = []
        //         }
        //       })
        //     }
        //   } else {
        //     // console.log(this.subcat_arr.length !== 0);
        //     if (this.size_arr.length == 0) {
        //       //cat price
        //       // console.log(this.snew_arr.length !== 0);
        //       this.product.price_filter_subcat(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id).subscribe(data => {
        //         if (data['data'] !== undefined) {
        //           this.productdata = data['data']
        //         }
        //         else {
        //           this.productdata = []
        //         }
        //       })



        //     } else if(this.size_arr.length !== 0){
        //       //  size cat price
        //       this.product.price_filter_cat(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.size_arr).subscribe(data => {
        //         if (data['data'] !== undefined) {
        //           this.productdata = data['data']
        //         }
        //         else {
        //           this.productdata = []
        //         }
        //       })
        //     }else{
        //          //cat
        //   this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
        //     this.productdata = data['data']
        //   })
        //     }

        //   }




         

        }
      //    if (this.subcat_arr.length != 0) {
      // } else {
      //   this.getproductby_cat()
      // }





      // if (this.subcat_arr.length != 0) {
      //   this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
      //     this.productdata = data['data']
      //   })
      // }
      // else {
      //   this.getproductby_cat()
      // }
    }
  }
  clr_array: any = []
  getproductby_color(e: any) {
    // console.log(this.slider_arr)

    this.clr_array = []
    if (e.target.value === 'on') {
      this.checkboxes.forEach((element) => {
        if (element.nativeElement.checked) {
          this.clr_array.push(element.nativeElement.id)
        } else {
          let index = this.snew_arr.indexOf(element.nativeElement.id);
          this.snew_arr.splice(index, 1);
        }
      });

      if (this.clr_array.length !== 0) {
        this.product.all_product_getall(this.clr_array, e.target.id, this.cat_id, this.size_arr, this.load_product).subscribe(data => {
          if (data['data'] !== undefined) {
            this.productdata = data['data']
          }
          else {
            this.productdata = []
          }
        })
      } else if (this.slider_arr.length !== 0) {
        this.product.price_filter_oneclr(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, e.target.id).subscribe(data => {
          if (data['data'] !== undefined) {
            this.productdata = data['data']
          }
          else {
            this.productdata = []
          }
        })
      }

      else {
        // console.log("ok")
        this.product.getproductbyclr_id(e.target.id, this.cat_id, this.load_product).subscribe(data => {
          this.productdata = data['data']
        })
      }
    }
  }
  snew_arr: any = [] //subcat temp arr
  clr_temp: any = []
  size_filter(e: any) {
    this.clr_temp = []
    // console.log(this.slider_arr)
    this.getcolorval.forEach((element) => {
      if (element.nativeElement.checked) {
        this.clr_temp.push(element.nativeElement.id)
      }
    });
    this.snew_arr = []
    if (e.target.checked) {
      this.checkboxes.forEach((element) => {
        if (element.nativeElement.checked) {
          this.snew_arr.push(element.nativeElement.id)
        }
      });
      this.size_arr.push(e.target.value)
      if (this.slider_arr.length !== 0) {
        console.log("ok")
        this.product.price_filter_sizeid(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.size_arr).subscribe(data => {
          if (data['data'] !== undefined) {
            this.productdata = data['data']
          }
          else {
            this.productdata = []
          }
        })
        if (this.snew_arr.length !== 0) {
          if (this.clr_temp.length !== 0) {
            this.product.all_product_getall(this.snew_arr, this.clr_temp, this.cat_id, this.size_arr, this.load_product).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })
          } else {
            this.product.all_product(this.snew_arr, this.size_arr, this.cat_id, this.load_product).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
                // console.log("Ff");/
              }
              else {
                this.productdata = []
              }
            })
          }

        }
        else {
          this.product.getproductbysize_id(this.size_arr, this.cat_id, this.load_product).subscribe(data => {
            this.productdata = data['data']
          })
        }
      } else {
        if (this.snew_arr.length !== 0) {
          if (this.clr_temp.length !== 0) {
            this.product.all_product_getall(this.snew_arr, this.clr_temp, this.cat_id, this.size_arr, this.load_product).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })
          } else {
            this.product.all_product(this.snew_arr, this.size_arr, this.cat_id, this.load_product).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
                // console.log("Ff");/
              }
              else {
                this.productdata = []
              }
            })
          }

        }
        else {
          this.product.getproductbysize_id(this.size_arr, this.cat_id, this.load_product).subscribe(data => {
            this.productdata = data['data']
          })
        }
      }
    }
    else {
      let index = this.size_arr.indexOf(e.target.value);
      this.size_arr.splice(index, 1);
      this.checkboxes.forEach((element) => {
        if (element.nativeElement.checked) {
          this.snew_arr.push(element.nativeElement.id)
        }
      });

      if (this.snew_arr.length !== 0) {

        if (this.size_arr.length == 0) {
          if (this.clr_temp.length !== 0) {
            this.product.all_product_getall(this.snew_arr, this.clr_temp, this.cat_id, this.size_arr, this.load_product).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })
          } else {
            this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
              this.productdata = data['data']
              // console.log(data['data'])
            })
          }

        } else if (this.clr_temp.length !== 0) {
          this.product.all_product_getall(this.snew_arr, this.clr_temp, this.cat_id, this.size_arr, this.load_product).subscribe(data => {
            if (data['data'] !== undefined) {
              this.productdata = data['data']
            }
            else {
              this.productdata = []
            }
          })
        }
        else {
          this.product.all_product(this.snew_arr, this.size_arr, this.cat_id, this.load_product).subscribe(data => {
            if (data['data'] !== undefined) {
              this.productdata = data['data']
            }
            else {
              this.productdata = []
            }
          })
        }

      } else if (this.size_arr.length !== 0) {
        this.product.getproductbysize_id(this.size_arr, this.cat_id, this.load_product).subscribe(data => {
          this.productdata = data['data']
        })
      } else if (this.slider_arr.length !== 0) {

        if (this.snew_arr.length !== 0) {
          if (this.clr_temp.length !== 0) {
            if (this.size_arr.length !== 0) {
              //all
              this.product.price_filter_size(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.clr_temp, this.size_arr).subscribe(data => {
                if (data['data'] !== undefined) {
                  this.productdata = data['data']
                }
                else {
                  this.productdata = []
                }
              })
            } else {
              //  cat clr
              this.product.price_filter_clr(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.clr_temp).subscribe(data => {
                if (data['data'] !== undefined) {
                  this.productdata = data['data']
                }
                else {
                  this.productdata = []
                }
              })
            }
          } else {
            // console.log(this.snew_arr.length !== 0);
            if (this.size_arr.length == 0) {
              //cat price
              // console.log(this.snew_arr.length !== 0);
              this.product.price_filter_subcat(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr).subscribe(data => {
                if (data['data'] !== undefined) {
                  this.productdata = data['data']
                }
                else {
                  this.productdata = []
                }
              })



            } else {
              //  size cat
              this.product.price_filter_cat(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id, this.subcat_arr, this.size_arr).subscribe(data => {
                if (data['data'] !== undefined) {
                  this.productdata = data['data']
                }
                else {
                  this.productdata = []
                }
              })
            }

          }

        } else {
          //cat
          this.product.price_filter(this.slider_arr[0], this.slider_arr[1], this.load_product, this.cat_id).subscribe(data => {
            if (data['data'] !== undefined) {
              this.productdata = data['data']
            }
            else {
              this.productdata = []
            }
          })

        }



      }
      else {

        this.getproductby_cat()
      }
    }
  }
  reset_radiobtn() {
    this.color_radio = null
    this.checkboxes.forEach((element) => {
      if (element.nativeElement.checked) {
        this.snew_arr.push(element.nativeElement.id)
      }
    });
    if (this.snew_arr.length !== 0) {
      if (this.size_arr.length !== 0) {
        this.product.all_product(this.snew_arr, this.size_arr, this.cat_id, this.load_product).subscribe(data => {
          if (data['data'] !== undefined) {
            this.productdata = data['data']
          }
          else {
            this.productdata = []
          }
        })
      } else {
        this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
          this.productdata = data['data']
        })
      }

    }
    else {
      this.getproductby_cat()
    }
  }
  reset_catbtn() {
    this.checkboxes.forEach((element) => {
      element.nativeElement.checked = false;
    });
    this.subcat_arr = [];
    this.getproductby_cat()
  }
  reset_sizebtn() {
    this.checkboxes2.forEach((element) => {
      element.nativeElement.checked = false;
    });
    if (this.snew_arr.length !== 0) {
      if (this.clr_temp.length !== 0) {
        this.product.all_product_getall(this.snew_arr, this.clr_temp, this.cat_id, this.size_arr, this.load_product).subscribe(data => {
          if (data['data'] !== undefined) {
            this.productdata = data['data']
          }
          else {
            this.productdata = []
          }
        })
      } else {
        this.product.getproductbysubcat_id(this.subcat_arr, this.cat_id, this.load_product).subscribe(data => {
          this.productdata = data['data']
        })
      }

    }
    else {
      this.getproductby_cat()
    }
  }
  loadmore_product(e: number) {
    this.load_product = e + 3;
    this.getproductby_cat()
  }
  sortby(e: any) {
    if (e.target.value !== '') {

      this.getcolorval.forEach((element) => {
        if (element.nativeElement.checked) {
          this.clr_temp.push(element.nativeElement.id)
        }
      });

      this.checkboxes.forEach((element) => {
        if (element.nativeElement.checked) {
          this.snew_arr.push(element.nativeElement.id)
        }
      });
      if (this.snew_arr.length !== 0) {
        if (this.clr_temp.length !== 0) {
          if (this.size_arr.length !== 0) {
            //all
            this.product.order_size(e.target.value, this.load_product, this.cat_id, this.subcat_arr, this.clr_temp, this.size_arr).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })
          } else {
            // //  cat clr
            console.log("ff")
            this.product.order_clr(e.target.value, this.load_product, this.cat_id, this.subcat_arr, this.clr_temp).subscribe(data => {
              if (data['data'] !== undefined) {
                this.productdata = data['data']
              }
              else {
                this.productdata = []
              }
            })
          }
        } else {

          //  size cat
          this.product.order_cat(e.target.value, this.load_product, this.cat_id, this.subcat_arr, this.size_arr).subscribe(data => {
            if (data['data'] !== undefined) {
              this.productdata = data['data']
            }
            else {
              this.productdata = []
            }
          })
        }

      } else {
        //cat
        this.product.getorderby(e.target.value, this.cat_id, this.load_product).subscribe(data => {
          this.productdata = data['data']
          console.log(data['data'])
        })

      }





    }
  }
  slider_arr: any = []
  size_temp_arr: any = []
  sliderEvent(e: any) {
    this.slider_arr = []
    this.slider_arr.push(e.value, e.highValue)

    this.getcolorval.forEach((element) => {
      if (element.nativeElement.checked) {
        this.clr_temp.push(element.nativeElement.id)
      }
    });
    // console.log(this.clr_temp)
    this.checkboxes.forEach((element) => {
      if (element.nativeElement.checked) {
        this.snew_arr.push(element.nativeElement.id)
      }
    });
    this.size_temp_arr = []
    this.checkboxes2.forEach((element) => {
      if (element.nativeElement.checked) {
        this.size_temp_arr.push(element.nativeElement.id)
      }
    });
    // console.log(this.size_temp_arr)
    if (this.size_temp_arr != 0) {
      this.product.price_filter_sizeid(e.value, e.highValue, this.load_product, this.cat_id, this.size_temp_arr).subscribe(data => {
        if (data['data'] !== undefined) {
          this.productdata = data['data']
        }
        else {
          this.productdata = []
        }
      })

    }
    if (this.snew_arr.length == 0 && this.size_arr.length == 0 && this.clr_temp.length != 0) {
      console.log("ok")
      this.product.price_filter_oneclr(e.value, e.highValue, this.load_product, this.cat_id, this.clr_temp).subscribe(data => {
        if (data['data'] !== undefined) {
          this.productdata = data['data']
        }
        else {
          this.productdata = []
        }
      })
    }
    if (this.snew_arr.length !== 0) {
      if (this.clr_temp.length !== 0) {
        if (this.size_arr.length !== 0) {
          //all
          this.product.price_filter_size(e.value, e.highValue, this.load_product, this.cat_id, this.subcat_arr, this.clr_temp, this.size_arr).subscribe(data => {
            if (data['data'] !== undefined) {
              this.productdata = data['data']
            }
            else {
              this.productdata = []
            }
          })
        } else {
          //  cat clr
          this.product.price_filter_clr(e.value, e.highValue, this.load_product, this.cat_id, this.subcat_arr, this.clr_temp).subscribe(data => {
            if (data['data'] !== undefined) {
              this.productdata = data['data']
            }
            else {
              this.productdata = []
            }
          })
        }
      } else {
        // console.log(this.snew_arr.length !== 0);
        if (this.size_arr.length == 0) {
          //cat price
          // console.log(this.snew_arr.length !== 0);
          this.product.price_filter_subcat(e.value, e.highValue, this.load_product, this.cat_id, this.subcat_arr).subscribe(data => {
            if (data['data'] !== undefined) {
              this.productdata = data['data']
            }
            else {
              this.productdata = []
            }
          })



        } else {
          //  size cat
          this.product.price_filter_cat(e.value, e.highValue, this.load_product, this.cat_id, this.subcat_arr, this.size_arr).subscribe(data => {
            if (data['data'] !== undefined) {
              this.productdata = data['data']
            }
            else {
              this.productdata = []
            }
          })
        }

      }

    } else if (this.snew_arr.length == 0 && this.size_arr.length == 0 && this.clr_temp.length == 0) {
      //cat
      this.product.price_filter(e.value, e.highValue, this.load_product, this.cat_id).subscribe(data => {
        if (data['data'] !== undefined) {
          this.productdata = data['data']
        }
        else {
          this.productdata = []
        }
      })

    }
  }
  addtocart(e: any) {
    this.cartService.addtoCart(e);
    // this.addtocart_alert=true
    // setTimeout(() => {
    //   this.addtocart_alert=false
    // }, 4000);
    // console.log(qty)
  }
}
