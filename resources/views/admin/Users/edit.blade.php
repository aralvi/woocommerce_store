
<form action="{{ route('users.update', $user->id ) }}" class="form-validate is-alter" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="form-label" for="Store Name">Name</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="url">Email</label>
        <div class="form-control-wrap">
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="Consumer Key">Password</label>
        <div class="form-control-wrap">
            <input type="password" class="form-control" name="password" value="{{ $user->password }}" required>
        </div>
    </div>
    


    </div>
    <div class="modal-footer bg-light">
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary">Update Informations</button>
        </div>
    </div>
</form>
