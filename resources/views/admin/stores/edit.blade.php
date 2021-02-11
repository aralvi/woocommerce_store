
<form action="{{ route('stores.update', $shop->id ) }}" class="form-validate is-alter" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="form-label" for="Store Name">Store Name</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control" name="name" value="{{ $shop->name }}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="url">Store URL</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control" name="url" value="{{ $shop->store_url }}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="Consumer Key">Consumer Key</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control" name="key" value="{{ $shop->consumer_key }}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="Consumer Secret">Consumer Secret</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control" name="secret" value="{{ $shop->consumer_secret }}" required>
        </div>
    </div>


    </div>
    <div class="modal-footer bg-light">
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-dim btn-primary">Update Informations</button>
        </div>
    </div>
</form>
