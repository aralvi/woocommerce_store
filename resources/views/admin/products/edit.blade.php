<form action="{{ route('products.update',$product['id']) }}" id="productEditForm" class="form-validate is-alter" method="POST">
                @method('put')
            <div class="modal-body">
                    @csrf
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="name" class="mb-0">Name</label>
                            <input type="text" name="name" id="name" value="{{ $product['name'] }}" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="regular_price" class="mb-0">Regular Price</label>
                            <input type="number" name="regular_price" id="regular_price"  value="{{ $product['regular_price'] }}" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sale_price" class="mb-0">Sale Price</label>
                            <input type="number" name="sale_price" id="sale_price" value="{{ $product['sale_price'] }}"  class="form-control">
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                </div>
            </div>
            </form>