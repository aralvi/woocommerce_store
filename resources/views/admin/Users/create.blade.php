@extends('layouts.admin') @section('title','Users') @section('page-title','Add User ')

@section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card border-none">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">User Detail</h5>
            </div>
            <form action="{{route('users.store')}}" method="POST">
            @csrf
            @method("POST")
                <div class="row g-4">   
                    <div class="col-lg-6">
                        <div class="form-group"><label class="form-label" for="full-name-1">Name</label>
                            <div class="form-control-wrap"><input type="text" name="name" class="form-control" id="full-name-1"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"><label class="form-label" for="email-address-1">Email </label>
                            <div class="form-control-wrap"><input type="text" name="email" class="form-control" id="email-address-1"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
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
    <!-- .card -->
</div>
@endsection @section('script')
<script>
    $("#orders_check").click(function() {
        if ($(this).is(':checked')) {

            $('.order_check').attr('checked', 'checked');
        } else {

            $('.order_check').removeAttr('checked', 'checked');

        }
    });
    $("#order_status").on('change', function() {
        $status = $(this).val();


        $.ajax({
            type: 'get',
            url: "{{ url('order')}}" + "/" + $status,
            success: function(data) {
                $('#order_table').empty();
                $('#order_table').html(data);
            }
        });

    });


    $('#search_order').on('input', function(e) {
        var query = $(this).val();
        $.ajax({
            type: "post",
            url: "{{ route('order.search')}}",
            data: {
                query: query,
                _token: "{{ csrf_token() }}"
            },

            success: function(data) {
                $('#order_table').empty();
                $('#order_table').html(data);
            },
        });

    });
</script>
@endsection