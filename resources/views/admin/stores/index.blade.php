@extends('layouts.admin') @section('title','Stores') @section('page-title','Add Store')

@section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
                {{-- card header section end --}}
                <div class="data">
                    @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                    @endif

                    <table class="datatable-init nk-tb-list nk-tb-ulist col-md-12" data-auto-responsive="false">
                        <thead class="thead-dark">
                            <tr class="nk-tb-item nk-tb-head">
                                <!-- <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" name="" class="order_check " id="orders_check">
                                    </div>
                                </th> -->
                                <th class="nk-tb-col">Id </th>
                                <th class="nk-tb-col tb-col-mb">Store Name</th>
                                <th class="nk-tb-col tb-col-md">Store Url</th>
                                <th class="nk-tb-col tb-col-lg">Actions</th>


                            </tr>
                        </thead>
                        <tbody id="order_table">


                            @foreach($stores as $store)

                            <tr class="nk-tb-item">

                                <td class="nk-tb-col">
                                    <div class="user-info">
                                        <span class="tb-lead"><span class="dot dot-success d-md-none ml-1"></span>{{$store->id}}</span>
                                    </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount"> {{$store->name}}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span class="tb-amount">{{$store->url}}</span>
                                </td>
                                


                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <a href="{{ route('stores.edit',$store->id)}}"><i class="icon ni ni-eye"></i></a>
                                </td>

                            </tr><!-- .nk-tb-item  -->
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
@endsection 