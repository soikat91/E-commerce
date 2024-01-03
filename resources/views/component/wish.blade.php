<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>WishList <span id="bName"></span></h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">This Page</a></li>
                  
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<div class="mt-5">
    <div class="container my-5">
        <div id="wishProduct" class="row">
           
        </div>
    </div>
</div>   


<script>
    
    WishProduct()
    async function WishProduct(){

        let res=await axios.get('/product-wish-list')
        $('#wishProduct').empty()
        res.data['data'].forEach((item)=>{

            let ProductList=`<div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="#">
                                            <img src="${item['product']['image']}" alt="product_img9">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                              
                                                <li><a href="/details?id=${item['product']['id']}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                              
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/details?id=${item['product']['id']}">${item['product']['title']}</a></h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item['product']['price']}</span>
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:${item['product']['star']}%"></div>
                                            </div>
                                        </div>
                                        <button class="remove btn btn-sm btn-danger" data-id=${item['product']['id']} >Remove</button>
                                    </div>
                                </div>
                            </div>
                            `
                   $('#wishProduct').append(ProductList) 
                   
        })

        $('.remove').on('click',function(){

        let id=$(this).data('id')
        
        RemoveWishProduct(id)
                    
        })
    }

    async function RemoveWishProduct(id){

        
        $('.preloader').delay(30).fadeIn(100).removeClass('loaded')
        let res=await axios.get('/product-wish-remove/'+id)
        $('.preloader').delay(30).fadeOut(100).addClass('loaded')
        if(res.status===200){

            await WishProduct()
        }else{

            alert('Something Wrong')
        }
    }

    
   

</script>
