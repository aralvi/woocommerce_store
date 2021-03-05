@extends('layouts.admin') @section('style')
<style>
	.product_barcode{
		width: 150px !important;
	}
	    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    
    #myImg:hover {
        opacity: 0.7;
    }
    /* The Modal (background) */
    
    .img-modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: unset !important;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto !important;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }
    /* img-modal Content (image) */
    
    .img-modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }
    /* Caption of img-modal Image */
    
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }
    /* Add Animation */
    
    .img-modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }
    
    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }
        to {
            -webkit-transform: scale(1)
        }
    }
    
    @keyframes zoom {
        from {
            transform: scale(0)
        }
        to {
            transform: scale(1)
        }
    }
    /* The Close Button */
    
    #close {
        position: absolute;
        top: 70px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }
    
    #close:hover,
    #close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
    /* 100% Image Width on Smaller Screens */
    
    @media only screen and (max-width: 700px) {
        .img-modal-content {
            width: 100%;
        }
    }
</style>
 @endsection @section('title','Order detail') @section('page-title','Order Detail #'. $orders['id']) @section('content')
<div class="col-xxl-12 col-sm-12">
	<div class="card card-preview">
		<div class="card-inner">
			<div class="col-md-12 d-flex justify-content-between mb-2 p-0">
				<div class="">
					<input type="text" name="barcode" id="barcode" class="form-control" placeholder="Scan Barcode" autofocus>
					<label class="d-none lbl_scan_alert"></label>
				</div>
				<div class="btn-group" aria-label="Basic example">
					<form action="{{ route('order.detail') }}" target="_blank" id="new_order_form" method="POST"> @csrf
						<div class="form-group">
							<input type="hidden" name="store_url" class="store_url" value="{{ isset($store_url)? $store_url : '' }}">
							<input type="hidden" name="consumer_key" class="consumer_key" value="{{ isset($consumer_key)? $consumer_key:'' }}">
							<input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ isset($consumer_secret)? $consumer_secret : '' }}">
							<input type="number" name="order_id" id="order_id" class="form-control" placeholder="Search Order#”">
							<button type="submit" class="d-none"></button>
						</div>
					</form> <a href="{{ $store_url."/wp-admin/post.php?post=".$orders['id']."&action=edit"}}" target="_blank" class="btn btn-dim btn-primary top-btn ml-1" ><em class="icon ni ni-eye"> Woocommerce</em></a>
					<button type="button" class="btn btn-sm btn-dim btn-primary ml-1 single_order_status top-btn" data-orderId="{{ $orders['id'] }}">Change Order status</button>
					<button type="button" class="btn btn-sm btn-dim btn-primary ml-1 orderNote top-btn" data-orderId="{{ $orders['id'] }}">Add Note</button>
					<button type="button" class="btn btn-sm btn-dim btn-primary ml-1  top-btn" data-toggle="modal" data-target="#AddCustomQuestionModal">Add Question</button>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th class=""> # </th>
							<th class=" ">Image</th>
							<th class="  ">Qty to ship</th>
							<th class="  ">
								<button class="border-0 btn btn-sm btn-primary btn-dim">-</button> Qty
								<button class="border-0 btn btn-sm btn-primary btn-dim">+</button>
							</th>
							<th class="  ">Sku</th>
							<th class="  ">supplier</th>
							<th class="  ">Barcode</th>
							<th class="  ">Product Name</th>
							<th class="  ">Price</th>
							<th class="  ">Scan status</th>
						</tr>
					</thead>
					<tbody> @foreach ($orders['line_items'] as $key=> $product)
						<tr class="">
							<td class=""> {{ $product->product_id }} </td>
							<td class="">
								<div class="user-info"> @php $single_product = Product::find($product->product_id); @endphp 
									@foreach ($single_product['images'] as $image) 
									<img id="myImg" class="product_image" src="{{ $image->src }}" alt="" width="60" height="60"> @break @endforeach </div>
							</td>
							<td class=" "> <span class="tb-amount ship_quantity">{{ $product->quantity }}</span>
								<input type="hidden" name="" id="" class="shipquantity{{ $key }}" value="{{ $product->quantity }}"> </td>
							<td class="td_quantity  ">
								<div class="d-flex justify-content-between align-items-center btn-group div_quantity">
									<button type="button" id="sub" class="sub border btn btn-sm btn-primary btn-dim">--</button>
									<button type="button" id="sub" class="sub border btn btn-sm btn-primary btn-dim" onclick="quantityIncrementDecrement('dec',this,{{ $key }})">-</button>
									<input type="number" id="1" value="0" min="0" class="quantity{{ $key }}" />
									<button type="button" id="add" class="add border btn btn-sm btn-primary btn-dim" onclick="quantityIncrementDecrement('inc',this,{{ $key }})">+</button>
									<button type="button" id="add" class="add border btn btn-sm btn-primary btn-dim">++</button>
								</div>
							</td>
							<td class=" " data-order="Email Verified - Kyc Unverified"> {{ $product->sku }} </td>
							<td class=" "> </td>
							<td class=" ">
								@foreach ($single_product['meta_data'] as $item)
								@if ($item->key =='_ywbc_barcode_display_value')
									
								<input type="text" name="barcode" value="{{ $item->value }}" class="form-control product_barcode" readonly> </td>
								@endif
									
								@endforeach
							<td class=" "> 
								<form action="{{ route('products.show',$product->product_id) }}" target="_blank" method="get">
									@csrf
									<input type="hidden" name="store_url" class="store_url" value="{{ isset($store_url)? $store_url : '' }}">
									<input type="hidden" name="consumer_key" class="consumer_key" value="{{ isset($consumer_key)? $consumer_key:'' }}">
									<input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ isset($consumer_secret)? $consumer_secret : '' }}">
									<button class="btn btn-dim border-0 bg-none text-primary" type="submit">{{ $product->name }} </button>
									
								</form>
							</td>
							<td class=" "> ${{ $product->price }} </td>
							<td class="">
								<label class="pack_status p-2">Un-Packed</label>
							</td>
						</tr>
						<!-- .nk-tb-item  -->@endforeach </tbody>
					<tfoot>
						<tr>
							<th colspan="3" class="text-right pt-3">Total Weight</th>
							<td>
								<input type="number" name="" id="" class="form-control" /> </td>
							<th colspan="3" class="text-right pt-3">Product count</th>
							<td colspan="2">
								<input type="number" name="count" value="" id="" class="form-control count" readonly /> </td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<!-- .card-preview -->
	<!-- .card -->
</div>
<div class="col-md-12 d-flex justify-content-between my-5 px-0 flex-wrap">
	<div class="col-md-6  h-25">
		<div class="card">
			<div class="nk-ecwg nk-ecwg6">
				<div class="card-inner"> {{-- card header section --}}
					<div class="card-title-group">
						<h3>Billing Address</h3> </div> {{-- card header section end --}}
					<div class="data">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>First Name</th>
									<td>{{ $orders['billing']->first_name }}</td>
								</tr>
								<tr>
									<th>Last Name</th>
									<td>{{ $orders['billing']->last_name }}</td>
								</tr>
								<tr>
									<th>Address Line 1</th>
									<td>{{ $orders['billing']->address_1 }}</td>
								</tr>
								<tr>
									<th>Address Line 2</th>
									<td>{{ $orders['billing']->address_2 }}</td>
								</tr>
								<tr>
									<th>City</th>
									<td>{{ $orders['billing']->city }}</td>
								</tr>
								<tr>
									<th>Postcode</th>
									<td>{{ $orders['billing']->postcode }}</td>
								</tr>
								<tr>
									<th>Country</th>
									<td>{{ $orders['billing']->country }}</td>
								</tr>
								<tr>
									<th>Email</th>
									<td>{{ $orders['billing']->email }}</td>
								</tr>
								<tr>
									<th>Phone</th>
									<td>{{ $orders['billing']->phone }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- .card-inner -->
			</div>
			<!-- .nk-ecwg -->
		</div>
	</div>
	<div class="col-md-6 h-25">
		<div class="card">
			<div class="nk-ecwg nk-ecwg6">
				<div class="card-inner"> {{-- card header section --}}
					<div class="card-title-group">
						<h3>Shipping Address</h3> </div> {{-- card header section end --}}
					<div class="data">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>First Name</th>
									<td>{{ $orders['shipping']->first_name }}</td>
								</tr>
								<tr>
									<th>Last Name</th>
									<td>{{ $orders['shipping']->last_name }}</td>
								</tr>
								<tr>
									<th>Address Line 1</th>
									<td>{{ $orders['shipping']->address_1 }}</td>
								</tr>
								<tr>
									<th>Address Line 2</th>
									<td>{{ $orders['shipping']->address_2 }}</td>
								</tr>
								<tr>
									<th>City</th>
									<td>{{ $orders['shipping']->city }}</td>
								</tr>
								<tr>
									<th>Postcode</th>
									<td>{{ $orders['shipping']->postcode }}</td>
								</tr>
								<tr>
									<th>Country</th>
									<td>{{ $orders['shipping']->country }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- .card-inner -->
			</div>
			<!-- .nk-ecwg -->
		</div>
	</div>
</div> {{-- order notes --}}
<div class="col-xxl-12 col-sm-12">
	<div class="card card-preview">
		<div class="card-inner">
			<div class="card-title-group">
				<h3>Order Notes</h3> </div>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Note</th>
							<th class="nk-tb-col tb-col-lg">Actions</th>
						</tr>
					</thead>
					<tbody> @foreach($ordreNotes as $ordreNote)
						@if ($ordreNote->author == 'WooCommerce')
							
						<tr id="target_{{ $ordreNote->id }}" style=" background: #d7cad2;">
							<th scope="row">{{ $ordreNote->id }}</th>
							<td>{{ $ordreNote->note }}</td>
							<td class="nk-tb-col tb-col-md"> {{--
								<button type="button" class="btn btn-dim btn-primary " data-storId="{{ $ordreNote->id }}"><i class="icon ni ni-pen"></i></button> --}}
								<button type="button" class="btn btn-trigger btn-icon deleteNote" data-NoteId="{{ $ordreNote->id }}"><em class="icon ni ni-trash"></em></button>
							</td>
						</tr> 
						@else
						<tr id="target_{{ $ordreNote->id }}" class="bg-warning">
							<th scope="row">{{ $ordreNote->id }}</th>
							<td>{{ $ordreNote->note }}</td>
							<td class="nk-tb-col tb-col-md"> {{--
								<button type="button" class="btn btn-dim btn-primary " data-storId="{{ $ordreNote->id }}"><i class="icon ni ni-pen"></i></button> --}}
								<button type="button" class="btn btn-trigger btn-icon deleteNote" data-NoteId="{{ $ordreNote->id }}"><em class="icon ni ni-trash"></em></button>
							</td>
						</tr>
						@endif
						
						
						@endforeach 
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- .card-preview -->
</div>
{{-- custom questions --}}
<div class="col-xxl-12 col-sm-12">
	<div class="card card-preview">
		<div class="card-inner">
			<div class="card-title-group">
				<h3>Order Noted</h3> </div>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Note</th>
							<th class="nk-tb-col tb-col-lg">Actions</th>
						</tr>
					</thead>
					<tbody> @foreach($questions as $question)
							
						<tr id="target_{{ $question->id }}" >
							<th scope="row">{{ $question->id }}</th>
							<td>{{ $question->question }}</td>
							<td class="nk-tb-col tb-col-md"> 
								<button type="button" class="btn btn-trigger btn-icon editQuestion" data-QuestionId="{{ $question->id }}" data-Question="{{ $question->question }}"><em class="icon ni ni-pen"></em></button>
								<button type="button" class="btn btn-trigger btn-icon deleteQuestion" data-QuestionId="{{ $question->id }}" ><em class="icon ni ni-trash"></em></button>
							</td>
						</tr> 
						
						
						
						@endforeach 
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- .card-preview -->
</div>
<div class="modal fade zoom" tabindex="-1" id="OrderStatusmodalForm">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Order Status</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close"> <em class="icon ni ni-cross"></em> </a>
			</div>
			<form action="{{ route('orders.index') }}" id="singleorderStatus" class="form-validate is-alter" method="POST"> @method('put')
				<div class="modal-body"> @csrf
					<div class="form-group">
						<label for="filter By Status" class="mb-0">Order Stataus</label>
						<select id="order_status" name="order_status" class="form-control form-select" data-search="on">
							<option disabled selected>Choose Status</option>
							<option value="pending">Pending payment</option>
							<option value="processing">Processing</option>
							<option value="on-hold">On hold</option>
							<option value="completed">Completed</option>
							<option value="cancelled">Cancelled</option>
							<option value="refunded">Refunded</option>
							<option value="failed">Failed</option>
						</select>
					</div>
				</div>
				<input type="hidden" name="store_url" class="store_url" value="{{ isset($store_url)? $store_url : '' }}">
				<input type="hidden" name="consumer_key" class="consumer_key" value="{{ isset($consumer_key)? $consumer_key:'' }}">
				<input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ isset($consumer_secret)? $consumer_secret : '' }}">
				<div class="modal-footer bg-light">
					<div class="form-group">
						<button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade zoom" tabindex="-1" id="OrderNoteModalForm">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Order Note</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close"> <em class="icon ni ni-cross"></em> </a>
			</div>
			<form action="{{ route('ordernotes.store') }}" class="form-validate is-alter" method="POST"> @csrf
				<div class="modal-body">
					<div class="form-group">
						<label class="form-label" for="ordernote">Order Note</label>
						<div class="form-control-wrap">
							<input type="hidden" name="order_id" value="" id="order_id">
							<textarea name="order_note" class="form-control" id="" cols="30" rows="3"></textarea> 
							{{-- <input type="text" class="form-control" name="order_note" required>  --}}
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
{{-- add question modal  --}}
<div class="modal fade zoom" tabindex="-1" id="AddCustomQuestionModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Custom Question</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close"> <em class="icon ni ni-cross"></em> </a>
			</div>
			<form action="{{ route('questions.store') }}" class="form-validate is-alter" method="POST"> @csrf
				<div class="modal-body">
					<div class="form-group">
						<label class="form-label" for="ordernote">Question</label>
						<div class="form-control-wrap">
							<input type="hidden" name="order_id" value="{{ $orders['id'] }}" id="order_id">
							{{-- <textarea name="question" class="form-control" id="" cols="30" rows="2"></textarea>  --}}
							<input type="text" class="form-control" name="question" placeholder="ask question" required> 
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
{{-- edit question modal  --}}
<div class="modal fade zoom" tabindex="-1" id="EditCustomQuestionModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Custom Question</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close"> <em class="icon ni ni-cross"></em> </a>
			</div>
			<form action="{{ route('questions.index') }}" class="form-validate is-alter" method="POST" id="editQuestionForm"> @csrf @method('PUT')
				<div class="modal-body">
					<div class="form-group">
						<label class="form-label" for="ordernote">Question</label>
						<div class="form-control-wrap">
							<input type="hidden" name="order_id" value="{{ $orders['id'] }}" id="order_id">
							{{-- <textarea name="question" class="form-control" id="" cols="30" rows="2"></textarea>  --}}
							<input type="text" class="form-control" name="question" id="question" placeholder="ask question" required> 
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
{{-- delete mdal --}}
<div class="modal fade zoom" tabindex="-1" id="DeleteNoteModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete Note</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close"> <em class="icon ni ni-cross"></em> </a>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this note?</p>
				<input type="hidden" name="store_url" class="store_url" value="{{ isset($store_url)? $store_url : '' }}">
				<input type="hidden" name="consumer_key" class="consumer_key" value="{{ isset($consumer_key)? $consumer_key:'' }}">
				<input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ isset($consumer_secret)? $consumer_secret : '' }}">
				<input type="hidden" name="order_id" class="order_id" value="{{ $orders['id'] }}"> 
			</div>
			<div class="modal-footer bg-light">
				<button class="btn btn-dim btn-danger" id="deleteNoteBtn">Yes,sure</button>
			</div>
		</div>
	</div>
</div> 

{{-- delete mdal --}}
<div class="modal fade zoom" tabindex="-1" id="DeleteQuestionModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete Question</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close"> <em class="icon ni ni-cross"></em> </a>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this question?</p>
				
			</div>
			<div class="modal-footer bg-light">
				<button class="btn btn-dim btn-danger" id="deleteQuestionBtn">Yes,sure</button>
			</div>
		</div>
	</div>
</div> 
<div id="myModal" class="modal img-modal">
    <span id="close">&times;</span>
    <img class="modal-content img-modal-content" id="img01">
    <div id="caption"></div>
</div>
@endsection @section('script')
<script>

	function quantityIncrementDecrement(status,ele,id)
	{
		if(status='inc'){$('.quantity'+id).val(parseInt($('.quantity'+id).val())+1);}else {$('.quantity'+id).val(parseInt($('.quantity'+id).val())-1);}
		
		let $quantity = parseInt($('.quantity'+id).val());
		let $ship_quantity = $('.shipquantity'+id).val();
		if($ship_quantity > $quantity) {
			$('.quantity'+id).removeClass('bg-danger');
			$('.quantity'+id).removeClass('bg-success');
			$('.quantity'+id).addClass('bg-warning');
		}
		else if($ship_quantity == $quantity) {
			$('.quantity'+id).removeClass('bg-warning');
			$('.quantity'+id).removeClass('bg-danger');
			$('.quantity'+id).addClass('bg-success');
			// $status.html('Packed').addClass(['bg-success', 'text-white']);
		}
		else if($ship_quantity < $quantity) {
			$('.quantity'+id).removeClass('bg-success');
			$('.quantity'+id).removeClass('bg-waning');
			$('.quantity'+id).addClass('bg-danger');
		}
	}
$(document).ready(function() {
	calculateTotal();
	// $(document.body).on("click", "button.add", function() {
	// 	$quantity = $(this).prev().val(+$(this).prev().val() + 1);
	// 	$ship_quantity = $(this).parent('div.div_quantity').parent('td.td_quantity').siblings('td').children('.ship_quantity').text();
	// 	$status = $(this).parent('div.div_quantity').parent('td.td_quantity').siblings('td').children('.pack_status');
	// 	if($ship_quantity > $quantity.val()) {
	// 		$quantity.removeClass('bg-danger');
	// 		$quantity.removeClass('bg-success');
	// 		$quantity.addClass('bg-warning');
	// 	}
	// 	if($ship_quantity == $quantity.val()) {
	// 		$quantity.removeClass('bg-warning');
	// 		$quantity.removeClass('bg-danger');
	// 		$quantity.addClass('bg-success');
	// 		$status.html('Packed').addClass(['bg-success', 'text-white']);
	// 	}
	// 	if($ship_quantity < $quantity.val()) {
	// 		$quantity.removeClass('bg-success');
	// 		$quantity.removeClass('bg-waning');
	// 		$quantity.addClass('bg-danger');
	// 	}
	// });
	// $(document.body).on("click", "button.sub", function() {
	// 	if($(this).next().val() > 1) {
	// 		$quantity = $(this).next().val(+$(this).next().val() - 1);
	// 		$ship_quantity = $(this).parent('div.div_quantity').parent('td.td_quantity').siblings('td').children('.ship_quantity').text();
	// 		$status = $(this).parent('div.div_quantity').parent('td.td_quantity').siblings('td').children('.pack_status');
	// 		if($ship_quantity > $quantity.val()) {
	// 			$quantity.removeClass('bg-danger');
	// 			$quantity.removeClass('bg-success');
	// 			$quantity.addClass('bg-warning');
	// 		}
	// 		if($ship_quantity == $quantity.val()) {
	// 			$quantity.removeClass('bg-warning');
	// 			$quantity.removeClass('bg-danger');
	// 			$quantity.addClass('bg-success');
	// 			$status.html('Packed').addClass(['bg-success', 'text-white']);
	// 		}
	// 		if($ship_quantity < $quantity.val()) {
	// 			$quantity.removeClass('bg-success');
	// 			$quantity.removeClass('bg-waning');
	// 			$quantity.addClass('bg-danger');
	// 		}
	// 	}
	// });

	function calculateTotal() {
		let inputs = document.querySelectorAll("td  input.shipquantity");
		let sum = 0;
		for(let input of inputs) {
			sum += +input.value;
		}
		let grandTotal = document.querySelector(".count");
		// console.log(sum);
		grandTotal.value = sum;
	}
	$("#barcode").change(function() {
		$barcode = $(this).val();
		var check = '';
		$('.product_barcode[value="' + $barcode + '"]').each(function() {
			$product_barcode = $('.product_barcode[value="' + $barcode + '"]');
			$quantity = $product_barcode.parent('td').siblings('td.td_quantity').children('div.div_quantity').children('input.quantity').val(1);
			$ship_quantity = $product_barcode.parent('td').siblings('td').children('.ship_quantity').text();
			$status = $product_barcode.parent('td').siblings('td').children('.pack_status');
			if($ship_quantity > $quantity.val()) {
				$quantity.removeClass('bg-danger');
				$quantity.removeClass('bg-success');
				$quantity.addClass('bg-warning');
			}
			if($ship_quantity == $quantity.val()) {
				$quantity.removeClass('bg-warning');
				$quantity.removeClass('bg-danger');
				$quantity.addClass('bg-success');
				$status.html('Packed').addClass(['bg-success', 'text-white']);
			}
			if($ship_quantity < $quantity.val()) {
				$quantity.removeClass('bg-success');
				$quantity.removeClass('bg-waning');
				$quantity.addClass('bg-danger');
			}
			check = 1;
		});
		if(check == 1) {
			$('.lbl_scan_alert').removeClass(['d-none', 'text-danger']).addClass('text-success').html('Scan Suuccessful');
		} else {
			$('.lbl_scan_alert').removeClass(['d-none', 'text-success']).addClass('text-danger').html('Incorrect barcode')
		}
		$('.top-btn').addClass('h-50')
		$(this).val('');
	});
	// view new order detail





});
</script> @endsection