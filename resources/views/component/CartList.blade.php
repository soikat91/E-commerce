<div class="section">
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive shop_cart_table">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="CartList">
                        	
                            
                           
                        </tbody>
                        <tfoot>
                        	<tr>
                            	<td colspan="6" class="px-0">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                            Total: $ <span id="total"></span>
                                        </div>
                                        <div class="col-lg-8 col-md-6  text-start  text-md-end">
                                            <button class="btn btn-line-fill btn-sm" type="submit">Check Out</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>      
    </div>
</div>


<script>
    
    cartList()
    async function cartList(){

        let res=await axios.get('product-cart-list')
        $('#CartList').empty()

        res.data['data'].forEach((item)=>{

            let EachCart=`<tr>
                            <td class="product-thumbnail"><a href="#"><img src="${item['product']['image']}" alt="product1"></a></td>
                            <td class="product-name" data-title="Product"><a href="#">${item['product']['title']}</a></td>
                            <td class="product-price" data-title="Price">${item['product']['price']}</td>
                            <td class="product-quantity" data-title="Quantity">${item['qty']}</td>
                            <td class="product-subtotal" data-title="Total">${item['price']}</td>
                            <td class="product-remove" data-title="Remove"><a class="remove" data-id="${item['product_id']}"><i class="ti-close"></i></a></td>
                        </tr>`

            $('#CartList').append(EachCart)         

        })
        await TotalPrice(res.data['data']);

        $('.remove').on('click',function(){ 
                
                let id=$(this).data('id')
                RemoveCart(id)
            })
    }

    async function RemoveCart(id){

        let res=await axios.get('/product-remove-cart/'+id)
        if(res.status===200){

            await cartList();

        }else{

            alert("Something Wrong")
        }
    }

    async function TotalPrice(data){

        let Total=0;
        data.forEach((item)=>{

            Total=Total+parseFloat(item['price'])

        })
        $('#total').text(Total)
    }

</script>

