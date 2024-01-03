<!-- START SECTION BANNER -->
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-bs-ride="carousel">
        <div id="homeslider" class="carousel-inner">


        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev"><i class="ion-chevron-left"></i></a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next"><i class="ion-chevron-right"></i></a>
       
    </div>
</div>
<!-- END SECTION BANNER -->


<script>


async function Slider(){

    let res=await axios.get('/product-slider');
    $('#homeslider').empty();

    res.data['data'].forEach((item,i)=>{
        let selectSlider=''
        if(i==0){
            selectSlider="active"
        }
        let eachslider=` 
            <div class="carousel-item background_bg ${selectSlider}" style="background-image: url('${item['image']}')">
                	<div class="container">
                    	<div class="row">
                            <div class="col-lg-7 col-9">
                                <div class="banner_content overflow-hidden">                                    
                                    <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="1s">Get up to <span class="text_default">50%</span> off Today Only!</h5>
                                    <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="0.5s">${item['title']}</h2>
                                    <a class="btn btn-fill-out staggered-animation text-uppercase" href="/details?id=${item['id']}" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</a>
                                </div>
                            </div>
                    	</div>
                    </div>
                </div>
            </div> `

         $('#homeslider').append(eachslider)
    })
}
    
</script>