@extends('layouts.admin') @section('title','Setting') @section('page-title','Setting') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group mb-3">
                    <h3>
                        Add Your Store Credentials
                    </h3>
                </div>
                {{-- card header section end --}}
                {{-- <div class="data">
                    <div class="row mb-4">
                    </div> --}}
                    {{-- <div class="card card-preview"> --}}
                        {{-- <div class="card-inner">
                            <div class="preview-block"> --}}
                                <div class="row gy-4">
                                    <form action="" method="post" class="col-sm-12">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label mb-0 mt-5" for="default-01">WOOCOMMERCE STORE URL</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="default-01"
                                                        placeholder="WOOCOMMERCE STORE URL">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label mb-0 mt-5" for="default-05">WOOCOMMERCE CONSUMER
                                                    KEY</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-text-hint">
                                                        <span class="overline-title"></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="default-05"
                                                        placeholder="WOOCOMMERCE CONSUMER KEY">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label mb-0 mt-5" for="default-05">WOOCOMMERCE CONSUMER
                                                    SECRET</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-text-hint">
                                                        <span class="overline-title"></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="default-05"
                                                        placeholder="WOOCOMMERCE CONSUMER SECRET">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <div class="form-group mt-3 float-right">
                                                <button class="btn btn-dim btn-primary ">Update Store Key</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            {{-- </div>
                        </div> --}}
                    {{-- </div><!-- .card-preview --> --}}
                {{-- </div> --}}
            </div>
            <!-- .card-inner -->
        </div>
        <!-- .nk-ecwg -->
    </div>
    <!-- .card -->
</div>
@endsection
