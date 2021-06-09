<table class="table table-bordered">
   <thead>
      <tr>
         <th>Image</th>
         <th>Details</th>
         <th>Quantity</th>
         <th>Unit Price</th>
         <th>Sub Total</th>
      </tr>
   </thead>
   <tbody>
      <?php $total_price = 0; ?>
      @foreach($userCartItems as $items)
      <tr>
         <td><img style="width:50px" src="{{ asset('images/products/'.$items['product']['product_image']) }}" alt="img"></td>
         <td>
            {{ $items['product']['product_name']}} <br>
            {{ $items['product']['product_code']}} <br>
            {{ $items['product']['product_color']}}
         </td>
         <td>
              <input style="max-width:34px" value="{{ $items['quantity'] }}" id="appendedInputButtons" size="16" type="text">
              <button type="button"  class="btn btn-primary btn-sm btnItemUpdate qtyMinus"   data-cartid="{{ $items['id'] }}">-</button>
              <button type="button"  class="btn btn-success btn-sm btnItemUpdate qtyPlus"    data-cartid="{{ $items['id'] }}">+</button>
              <button type="button"  class="btn btn-danger btn-sm btnItemDelete" data-cartid="{{ $items['id'] }}">x</i></button>	
           </td>
         <td>{{ $items['product']['product_price'] }}</td>
         <td>{{ $items['quantity'] * $items['product']['product_price'] }}</td>
      </tr>
      <?php $total_price = $total_price+($items['quantity'] * $items['product']['product_price']) ?>
      @endforeach
      <tr>
        <td colspan="4" class="text-end">Total Price</td>
        <td>{{ $total_price }}</td>
     </tr>
   </tbody>
</table>