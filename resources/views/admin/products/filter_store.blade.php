@if (isset($products))
                                
                            @foreach ($products as $product)
                                
                            <tr class="nk-tb-item">
                                
                                <td class="nk-tb-col">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $product->id }}<span  class="dot dot-success d-md-none ml-1"></span></span>
                                        </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <div class="user-info">
                                    
                                    @if (count($product->images) <> 0) <img src="{{ $product->images[0]->src }}" alt=""
                                        width="60" height="60">
                                        @endif
                                       
                                </div>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $product->name }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    {{ $product->sku }}
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    <input type="text" name="barcode" class="form-control">
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                     <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" id="sub" class="sub border">--</button>
                                    <button type="button" id="sub" class="sub border">-</button>
                                    <input type="number" id="1" value="0" min="0" class="quantity" />
                                    <button type="button" id="add" class="add border">+</button>
                                    <button type="button" id="add" class="add border">++</button>
                                </div>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                   <a class="btn btn-dim btn-sm btn-primary" href="{{ route('products.show',$product->id) }}"><i
                                            class="icon ni ni-eye"></i></a>
                                            <button type="button" class="btn btn-sm btn-dim btn-primary editProduct"    
                                        data-productId="{{ $product->id }}" data-productPrice="{{ $product->regular_price }}" data-salePrice="{{ $product->sale_price }}"><i class="icon ni ni-pen"></i></button>
                                            <button type="button" class="btn btn-sm btn-dim btn-primary deleteProduct"
                                        data-productId="{{ $product->id }}" d><i class="icon ni ni-trash"></i></button>
                                </td>
                                
                            </tr><!-- .nk-tb-item  -->
                            @endforeach
                            @endif