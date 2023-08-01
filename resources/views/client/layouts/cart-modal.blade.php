@php
$cart_customer_id = Auth::user()->Customer;
print_r($cart_customer_id)
@endphp
<input type="hidden" value="{{ $cart_customer_id }}" id="cart_customer_id" >

<div class="modal fade" id="cart_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">
          Your Shopping Cart
        </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col"><span><i class="fa fa-cog"></i></span></th>
                        </tr>
                    </thead>
                    <tbody id="show_cart">

                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <h5 class="text-dark">Total: <span class="price text-success" id="cart_total"></span></h5>
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="checkout.html"><button type="button" class="btn btn-success">Checkout</button></a>
            </div>
        </div>
    </div>
</div>