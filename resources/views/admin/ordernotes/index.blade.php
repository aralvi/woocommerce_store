@extends('layouts.admin') @section('title','Order Notes') @section('page-title','Order Notes')

@section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group">
                </div>
                {{-- card header section end --}}
                <div class="data">
                    <table class="datatable-init nk-tb-list nk-tb-ulist col-md-12" data-auto-responsive="false">
                        <thead class="thead-dark">
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col">Id </th>
                                <th class="nk-tb-col tb-col-mb">Note</th>
                                {{-- <th class="nk-tb-col tb-col-lg">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordreNotes as $ordreNote)
                            <tr class="nk-tb-item" id="target_{{ $ordreNote->id }}">
                                <td class="nk-tb-col">
                                    <div class="user-info">
                                        <span class="tb-lead"><span
                                                class="dot dot-success d-md-none ml-1"></span>{{$ordreNote->id}}</span>
                                    </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount"> {{$ordreNote->note}}</span>
                                </td>

                                {{-- <td class="nk-tb-col tb-col-md">
                                    <button type="button" class="btn btn-dim btn-primary editStore"
                                        data-storId="{{ $ordreNote->id }}"><i class="icon ni ni-pen"></i></button>
                                <button type="button" class="btn btn-dim btn-primary deleteStore"
                                    data-storId="{{ $ordreNote->id }}"><i class="icon ni ni-trash"></i></button>
                                </td> --}}
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
