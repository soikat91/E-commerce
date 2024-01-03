<!-- START HEADER -->
<header class="header_wrap fixed-top header_with_topbar">
	<div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="lng_dropdown me-2">
                            <select name="countries" class="custome_select">
                                <option value='en' data-image="assets/images/eng.png" data-title="English">English</option>
                                <option value='fn' data-image="assets/images/fn.png" data-title="France">France</option>
                                <option value='us' data-image="assets/images/us.png" data-title="United States">United States</option>
                            </select>
                        </div>
                        <div class="me-3">
                            <select name="countries" class="custome_select">
                                <option value='USD' data-title="USD">USD</option>
                                <option value='EUR' data-title="EUR">EUR</option>
                                <option value='GBR' data-title="GBR">GBR</option>
                            </select>
                        </div>
                        <ul class="contact_detail text-center text-lg-start">
                            <li><i class="ti-mobile"></i><span>123-456-7890</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="text-center text-md-end">
                       	<ul class="header_list">                        	
                            <li><a href="/"><span>About</span></a></li>
                            @if (Cookie::get('token')!==null)
                                <li><a href="/login"><i class="ti-user"></i><span>Account</span></a></li>
                                <li><a class="btn btn-danger btn-sm" href="{{ url('/user-logout') }}"><span>Logout</span></a></li>
                            @else
                                <li><a class="btn btn-danger btn-sm" href="/login"><span>Login</span></a></li>
                            @endif
                            
						</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase">
    	<div class="container">
            <nav class="navbar navbar-expand-lg"> 
                <a class="navbar-brand" href="{{url('/')}}">
                    <img class="logo_light" src="assets/images/logo_light.png" alt="logo" />
                    <img class="logo_dark" src="assets/images/logo_dark.png" alt="logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="dropdown">
                            <a  class="nav-link nav_item" href="{{url('/') }}">Home</a>                               
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Prodcut</a>
                            <div class="dropdown-menu">
                                <ul id="CategoryName">                                                            
                                   
                                                                      
                                </ul>
                            </div>
                        </li>                       
                        <li><a href="/cart" class="nav-link nav_item"><i class="icon-basket-loaded"></i> Cart</a></li>
                        <li><a href="/wish" class="nav-link nav_item"><i class="ti-heart"></i> Wishlist</a></li>
                        <li><a class="nav-link nav_item" href="/PolicyByType?type=contact">Contact Us</a></li> 
                    </ul>
                </div>
                
            </nav>
        </div>
    </div>
</header>
<!-- END HEADER -->

<script>
    
    
    async function catgoryName(){

        let res=await axios.get('/category-list');
        $('#CategoryName').empty()

            res.data['data'].forEach((item)=>{
                
                let eachItem=` <li><a class="dropdown-item nav-link nav_item" href="/category-product?id=${item['id']}">${item['categories_name']}</a></li> `
                $('#CategoryName').append(eachItem)
            })
        }
    

</script>