 @if (isset($products))
                                
                            @foreach ($products as $product)
                                
                           <tr class="nk-tb-item">
                                
                                <td class="nk-tb-col">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $product->id }}<span  class="dot dot-success d-md-none ml-1"></span></span>
                                        </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    @if (count($product->images) <> 0) <img id="myImg" class="product_image" alt="Snow" style="width:100%;max-width:300px" src="{{ $product->images[0]->src }}" alt=""
                                        width="60" height="60">
                                        @endif

                                   
                                    
                                    
                                       
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <a href="{{ route('products.show',$product->id) }}">{{ $product->name }}</a>
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    {{ $product->sku }}
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    <input type="text" name="barcode" class="form-control">
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    @if ($product->stock_status == 'instock')
                                        <p class="text-success">

                                            {{ $product->stock_status }}
                                        </p>
                                        @else
                                        <p class="text-danger">

                                            {{ $product->stock_status }}
                                        </p>
                                        
                                    @endif
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <form action="{{ route('products.show',$product->id) }}" >
                                <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                                <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                                <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                                <button type="submit" class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></button>
                                </form>
                                   {{-- <a class="btn btn-dim btn-sm btn-primary" href="{{ route('products.show',$product->id) }}"><i --}}
                                            {{-- class="icon ni ni-eye"></i></a> --}}
                                            {{-- <button type="button" class="btn btn-sm btn-dim btn-primary editProduct"    
                                        data-productId="{{ $product->id }}" data-productPrice="{{ $product->regular_price }}" data-salePrice="{{ $product->sale_price }}"><i class="icon ni ni-pen"></i></button>
                                            <button type="button" class="btn btn-sm btn-dim btn-primary deleteProduct"
                                        data-productId="{{ $product->id }}" d><i class="icon ni ni-trash"></i></button> --}}
                                </td>
                                
                            </tr><!-- .nk-tb-item  -->
                            @endforeach
                            @endif
                            <script>
                                    // Get the modal

$(document.body).on("click", "img.product_image", function () {
             // Get the modal
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = $(this).attr('src');

        // Get the <span> element that closes the modal
        var span = document.getElementById("close");

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
        modal.style.display = "none";
        }
        });
                            </script>