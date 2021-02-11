@extends('layouts.admin') @section('title','Users') @section('page-title','User Management')

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
                                <th class="nk-tb-col tb-col-mb">User Name</th>
                                <th class="nk-tb-col tb-col-md">Email</th>
                                <th class="nk-tb-col tb-col-lg">Actions</th>
                              
                                
                            </tr>
                        </thead>
                        <tbody id="order_table">

                       
                       @foreach($Users as $user)
                                
                            <tr class="nk-tb-item">
                                
                                <td class="nk-tb-col">
                                        <div class="user-info">
                                            <span class="tb-lead"><span  class="dot dot-success d-md-none ml-1"></span>{{$user->id}}</span>
                                        </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount"> {{$user->name}}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span class="tb-amount">{{$user->email}}</span>
                                </td>
                               
                             
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                   <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="icon ni ni-pen"></i></a>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: -17%;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('users.update',$user->id)}}" method="POST">
            @csrf
            @method("PUT")
                <div class="row g-4">   
                    <div class="col-lg-12">
                        <div class="form-group"><label class="form-label" for="full-name-1">Name</label>
                            <div class="form-control-wrap"><input type="text" name="name" class="form-control" id="full-name-1"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group"><label class="form-label" for="email-address-1">Email </label>
                            <div class="form-control-wrap"><input type="text" name="email" class="form-control" id="email-address-1"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group"><label class="form-label" for="phone-no-1">password</label>
                            <div class="form-control-wrap"><input type="text" name="password" class="form-control" id="phone-no-1"></div>
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
@endsection @section('script')
<script>
    $("#orders_check").click( function(){
   if( $(this).is(':checked') ){

        $('.order_check').attr('checked','checked');
   }else{
        
        $('.order_check').removeAttr('checked','checked');

   }
});
    $("#order_status").on('change', function () {
        $status = $(this).val();


        $.ajax({
            type: 'get',
            url: "{{ url('order')}}" + "/" + $status,
            success: function (data) {
                $('#order_table').empty();
                $('#order_table').html(data);
            }
        });

    });

    
    $('#search_order').on('input', function (e) {
        var query = $(this).val();
        $.ajax({
            type: "post",
            url: "{{ route('order.search')}}",
            data: {
                query: query,
                _token: "{{ csrf_token() }}"
            },

            success: function (data) {
                $('#order_table').empty();
                $('#order_table').html(data);
            },
        });

    });

</script>
@endsection
