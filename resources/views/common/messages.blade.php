<div id="success_errror_any">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 invalidOrderIdError">
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-block" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ session('success') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-block" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ session('warning') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-block" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ session('error') }}</strong>
                    </div>

                </div>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="container-fluid">
            <div class="alert alert-danger alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>