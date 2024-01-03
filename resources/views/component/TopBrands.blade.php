<!-- START SECTION BLOG -->
<div class="section">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-md-6">
            	<div class="heading_s4 text-center">
                	<h2>Top Brands</h2>
                </div>
                <p class="leads text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
            </div>
        </div>
        <div id="brandName" class="row align-items-center">
        	<div class="p-2 col-2">
            	<div class="item">
                	<div class="categories_box">
                        <a href="#">
                            <img src="assets/images/el_blog_img1.jpg" alt="el_blog_img1">
                        </a>
                        <span>Brand Name</span>
                    </div>
                 
                </div>
            </div>             
    
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->


<script>

    BrandName()
    async function BrandName(){
        
        let res=await axios.get('/brand-list');
        $('#brandName').empty()
        
        res.data['data'].forEach((item)=>{

            let EachItem=`<div  class="p-2 col-2">
                    
                    <div class="item">
                        <div  class="categories_box">
                            <a href="/brand-product?id=${item['id']}">
                                <img src="${item['brand_img']}" alt="cat_img1"/>
                                <span>${item['brand_name']}</span>
                            </a>
                        </div>
                    </div>              
          
            </div>`
            $('#brandName').append(EachItem)            

        })
    }
</script>