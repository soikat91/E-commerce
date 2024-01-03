<!-- START SECTION CATEGORIES -->
<div class="section">
	<div class="container">
    	<div class="row justify-content-center">
			<div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>Top Categories</h2>
                </div>
                <p class="text-center leads">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius.</p>
            </div>
		</div>
        <div id="categoryName" class="row align-items-center">
              

        </div>
    </div>
</div>
<!-- END SECTION CATEGORIES --> 


<script>

    CategoryName()
    async function CategoryName(){
        
        let res=await axios.get('/category-list');
        $('#categoryName').empty()
        
        res.data['data'].forEach((item)=>{

            let EachItem=`<div  class="p-2 col-2">
                    
                    <div class="item">
                        <div  class="categories_box">
                            <a href="/category-product?id=${item['id']}">
                                <img src="${item['categories_img']}" alt="cat_img1"/>
                                <span>${item['categories_name']}</span>
                            </a>
                        </div>
                    </div>              
          
            </div>`

            $('#categoryName').append(EachItem)             

        })

    }
</script>