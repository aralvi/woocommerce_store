@extends('layouts.admin') @section('title','Stores') @section('page-title','Add Store')

@section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group">
                    <button type="button" class="btn btn-dim btn-primary" data-toggle="modal"
                        data-target="#modalForm">Add Store</button>
                </div>
                {{-- card header section end --}}
                <div class="data">


                    <table class="datatable-init nk-tb-list nk-tb-ulist col-md-12" data-auto-responsive="false">
                        <thead class="thead-dark">
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col">Id </th>
                                <th class="nk-tb-col tb-col-mb">Store Name</th>
                                <th class="nk-tb-col tb-col-md">Store Url</th>
                                <th class="nk-tb-col tb-col-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shops as $shop)
                            @if ($shop->user_id == Auth::user()->id || $shop->user_id == Auth::user()->parent_id || Auth::user()->role == 'SuperAdmin')
                                
                            <tr class="nk-tb-item" id="target_{{ $shop->id }}">
                                <td class="nk-tb-col">
                                    <div class="user-info">
                                        <span class="tb-lead"><span
                                                class="dot dot-success d-md-none ml-1"></span>{{$shop->id}}</span>
                                    </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount"> {{$shop->name}}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span class="tb-amount">{{$shop->store_url}}</span>
                                </td>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <button type="button" class="btn btn-dim btn-primary editStore"
                                        data-storId="{{ $shop->id }}"><i class="icon ni ni-pen"></i></button>
                                        @if ($shop->user_id == Auth::user()->id || Auth::user()->role == 'SuperAdmin')
                                            
                                        <button type="button" class="btn btn-dim btn-primary deleteStore"
                                            data-storId="{{ $shop->id }}"><i class="icon ni ni-trash"></i></button>
                                        @endif
                                </td>
                            </tr><!-- .nk-tb-item  -->
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- .card-inner -->
        </div>
        <!-- .nk-ecwg -->
    </div>
    <!-- .card -->
</div>

<div class="modal fade zoom" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Store</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('stores.store') }}" class="form-validate is-alter" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="Store Name">Store Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="url">Store URL</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="url" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="Consumer Key">Consumer Key</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="key" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="Consumer Secret">Consumer Secret</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="secret" required>
                        </div>
                    </div>


            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>



{{-- delete mdal  --}}

<div class="modal fade zoom" tabindex="-1" id="DeleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Store</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delte this store?</p>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-dim btn-danger" id="deleteStoreBtn">Yes,sure</button>
            </div>
        </div>
    </div>
</div>

{{-- edit modal --}}
<div class="modal fade zoom" tabindex="-1" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Store</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body requestStore">


            </div>
        </div>
    </div>
    @endsection
