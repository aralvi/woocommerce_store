 @if (isset($products))
                                
                            @foreach ($products as $product)
                                
                            <tr class="nk-tb-item">
                                
                                <td class="nk-tb-col">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $product->id }}<span  class="dot dot-success d-md-none ml-1"></span></span>
                                        </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    @if (count($product->images) <> 0) <img id="myImg"  alt="Snow" style="width:100%;max-width:300px" src="{{ $product->images[0]->src }}" alt=""
                                        width="60" height="60">
                                        @endif

                                    <!-- The Modal -->
                                    <div id="myModal" class="modal">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="img01">
                                    <div id="caption"></div>
                                    </div>
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
                                     
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                   <a class="btn btn-dim btn-sm btn-primary" href="{{ route('products.show',$product->id) }}"><i
                                            class="icon ni ni-eye"></i></a>
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
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
// var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
                            </script>