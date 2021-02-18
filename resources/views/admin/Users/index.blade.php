@extends('layouts.admin') @section('title','Users') @section('page-title','Add User') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group">
                    <button type="button" class="btn btn-dim btn-primary" data-toggle="modal" data-target="#modalForm">Add User</button>
                </div>
                {{-- card header section end --}}
                <div class="data">
                    <table class="datatable-init nk-tb-list nk-tb-ulist col-md-12" data-auto-responsive="false">
                        <thead class="thead-dark">
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col">Id</th>
                                <th class="nk-tb-col tb-col-mb">User Name</th>
                                <th class="nk-tb-col tb-col-mb">Role</th>
                                <th class="nk-tb-col tb-col-md">Email</th>
                                <th class="nk-tb-col tb-col-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Users as $user)
                                @if (($user->parent_id == Auth::user()->id && $user->role != 'SuperAdmin'  || Auth::user()->parent_id == $user->parent_id && Auth::user()->id != $user->id )|| (Auth::user()->role == 'SuperAdmin') )
                                    <tr class="nk-tb-item" id="target_{{ $user->id }}">
                                        <td class="nk-tb-col">
                                            <div class="user-info">
                                                <span class="tb-lead"><span class="dot dot-success d-md-none ml-1"></span>{{$user->id}}</span>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
                                            <span class="tb-amount"> {{$user->name}}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
                                            <span class="tb-amount"> {{$user->role}}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="tb-amount">{{$user->email}}</span>
                                        </td>
                                        <!-- <td class="nk-tb-col tb-col-md">
                                            <span class="tb-amount">{{$user->password}}</span>
                                        </td> -->

                                        <td class="nk-tb-col tb-col-md">
                                            <button type="button" class="btn btn-dim btn-primary editUser" data-userId="{{ $user->id }}"><i class="icon ni ni-pen"></i></button>
                                            @if ($user->role != 'SuperAdmin' && $user->id !=Auth::user()->id && $user->parent_id == Auth::user()->id)
                                                
                                            <button type="button" class="btn btn-dim btn-primary deleteUser" data-userId="{{ $user->id }}"><i class="icon ni ni-trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            <!-- .nk-tb-item  -->
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

{{-- Add modal --}}

<div class="modal fade zoom" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{route('users.store')}}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Name</label>
                                <div class="form-control-wrap"><input type="text" name="name" class="form-control" id="full-name-1" /></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address-1">Email </label>
                                <div class="form-control-wrap"><input type="email" name="email" class="form-control" id="email-address-1" /></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="phone-no-1">password</label>
                                <div class="form-control-wrap"><input type="password" name="password" class="form-control" id="phone-no-1" /></div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary">Save Informations</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

  
    </div>
    {{-- delete mdal --}}

<div class="modal fade zoom" tabindex="-1" id="DeleteUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delte this user?</p>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-dim btn-danger" id="deleteModalBtn">Yes,sure</button>
            </div>
        </div>
    </div>
</div>

{{-- edit modal --}}
<div class="modal fade zoom" tabindex="-1" id="editUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body requestdata"></div>
        </div>
    </div>
</div>
        @endsection
    
@section('expiry_time')
	@if (isset($setting))
            
        <input type="hidden"  id="expiry_page_time" value="{{ $setting->expiry_time }}">
        @else
        <input type="hidden"  id="expiry_page_time" value="900000">
            
        @endif
@endsection