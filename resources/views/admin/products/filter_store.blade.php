
<div class="spinner-border text-secondary d-none" id="loading" role="status">
                            <span class="sr-only">

                            </span>
                        </div>
                        <table class="datatable-init nowrap nk-tb-list is-separate dataTable no-footer"
                            data-auto-responsive="false">
    <thead class="thead-dark">
        <tr class="nk-tb-item nk-tb-head">
            <th class="nk-tb-col"># </th>
            <th class="nk-tb-col nk-tb-col-check">Image</th>
            <th class="nk-tb-col">Name </th>
            <th class="nk-tb-col tb-col-mb">Sku</th>
            <th class="nk-tb-col tb-col-md">Barcode</th>
            <th class="nk-tb-col tb-col-lg">Stock Status</th>
            <th class="nk-tb-col tb-col-md">Action</th>

        </tr>
    </thead>
    <tbody id="product_table">
        @if (isset($products))

        @foreach ($products as $product)

        <tr class="nk-tb-item">

            <td class="nk-tb-col">
                <div class="user-info">
                    <span class="tb-lead">{{ $product->id }}<span class="dot dot-success d-md-none ml-1"></span></span>
                </div>
            </td>
            <td class="nk-tb-col tb-col-mb">
                @if (count($product->images) <> 0) <img id="myImg" class="product_image" alt="Snow"
                        style="width:100%;max-width:300px" src="{{ $product->images[0]->src }}" alt="" width="60"
                        height="60">
                    @endif





            </td>
            <td class="nk-tb-col tb-col-md">
                <form action="{{ route('products.show',$product->id) }}">
                    <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                    <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                    <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                    <button type="submit" class="text-primary btn btn-dim text-left">{{ $product->name }}</button>
                </form>
                {{-- <a href="{{ route('products.show',$product->id) }}">{{ $product->name }}</a> --}}
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
                <form action="{{ route('products.show',$product->id) }}">
                    <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                    <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                    <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                    <button type="submit" class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></button>
                </form>
                
            </td>

        </tr><!-- .nk-tb-item  -->
        @endforeach
        @endif
    </tbody>
</table>
<script src="{{ asset('assets/js/bundle.js?ver=2.3.0') }}"></script>
<script src="{{ asset('assets/js/scripts.js?ver=2.3.0') }}"></script>
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
        span.onclick = function () {
            modal.style.display = "none";
        }
    });

</script>
