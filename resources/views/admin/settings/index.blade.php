@extends('layouts.admin') @section('title','Setting') @section('page-title','Setting') @section('content')
<div class="col-xxl-12 col-sm-12">
	<div class="card">
		<div class="nk-ecwg nk-ecwg6">
			<div class="card-inner"> {{-- card header section --}}
				<div class="card-title-group mb-3">
					<h4>
                        Update Setting
                    </h4> </div>
				<div class="row gy-4">
					<form action="" method="post" class="col-sm-12" enctype="multipart/form-data"> @csrf
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="" class="mb-0">Select Store</label>
									<div class="form-control-wrap">
										<select class="form-select form-control form-control-lg" id="stores" name="store" data-search="on">
											<option value="default_option">Choose store</option> @if (isset($shops)) @foreach ($shops as $shop) @if (Auth::user()->id == $shop->user_id)
											<option class="text-capitalize" value="{{ $shop->id }}" @if ($setting !=null) {{ ($shop->id == $setting->shop_id) ? "selected":'' }} @endif> {{ $shop->name }}</option> @endif @endforeach @endif </select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="filter By Status" class="mb-0">Filter Status</label>
									<select id="order_status" name="order_status" class="form-control form-select" data-search="on"> @if (isset($setting))
										<option value="all" @if ($setting !=null) @if ( 'all'==$setting->order_status) selected @endif @endif >All</option>
										<option value="pending" @if ($setting !=null) @if ( 'pending'==$setting->order_status) selected @endif @endif >Pending payment</option>
										<option value="processing" @if ($setting !=null) @if ( 'processing'==$setting->order_status) selected @endif @endif >Processing</option>
										<option value="on-hold" @if ($setting !=null) @if ( 'on-hold'==$setting->order_status) selected @endif @endif >On hold</option>
										<option value="completed" @if ($setting !=null) @if ( 'completed'==$setting->order_status) selected @endif @endif >Completed</option>
										<option value="cancelled" @if ($setting !=null) @if ( 'cancelled'==$setting->order_status) selected @endif @endif >Cancelled</option>
										<option value="refunded" @if ($setting !=null) @if ( 'refunded'==$setting->order_status) selected @endif @endif >Refunded</option>
										<option value="failed" @if ($setting !=null) @if ( 'failed'==$setting->order_status) selected @endif @endif >Failed</option> @endif </select>
								</div>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="" class="mb-0">Exclude Status</label>
									<div class="form-control-wrap">
										<select class="form-select select2-hidden-accessible" id="excluded_status" name="excluded_status[]" multiple="" data-placeholder="Select Exclude Status" data-select2-id="9" tabindex="-1" aria-hidden="true"> @if (isset($setting)) @php 
											if (isset($setting->excluded_Status)) {
												$excluded_statuses = json_decode($setting->excluded_Status); 
											}
											@endphp
											<option value="pending" @if ($setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse == 'pending' ) selected @endif @endforeach
											@endif
											@endif >Pending payment</option>
											<option value="processing" @if ($setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='processing' ) selected @endif @endforeach
											@endif
											@endif >Processing</option>
											<option value="on-hold" @if ($setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='on-hold' ) selected @endif @endforeach
											@endif
											@endif >On hold</option>
											<option value="completed" @if ($setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='completed' ) selected @endif @endforeach
											@endif
											@endif >Completed</option>
											<option value="cancelled" @if ($setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='cancelled' ) selected @endif @endforeach
											@endif
											@endif >Cancelled</option>
											<option value="refunded" @if ($setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='refunded' ) selected @endif @endforeach
											@endif
											@endif >Refunded</option>
											<option value="failed" @if ($setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='failed' ) selected @endif @endforeach
											@endif
											@endif >Failed</option> @endif </select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="filter By Status" class="mb-0">Changeable Status</label>
									<select class="form-select select2-hidden-accessible" id="change_able_status" name="change_able_status[]" multiple="" data-placeholder="Select Changeable Status" data-select2-id="10" tabindex="-1" aria-hidden="true">@if (isset($setting)) 
										@php 
										if ($setting->change_able_Status) {
											$change_able_statuses = json_decode($setting->change_able_Status); 
										}
										@endphp
											<option value="pending" @if ($setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse == 'pending' ) selected @endif @endforeach
											@endif
												 @endif >Pending payment</option>
											<option value="processing" @if ($setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='processing' ) selected @endif @endforeach
											@endif
												 @endif >Processing</option>
											<option value="on-hold" @if ($setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='on-hold' ) selected @endif @endforeach
											@endif
												 @endif >On hold</option>
											<option value="completed" @if ($setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='completed' ) selected @endif @endforeach
											@endif
												 @endif >Completed</option>
											<option value="cancelled" @if ($setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='cancelled' ) selected @endif @endforeach
											@endif
												 @endif >Cancelled</option>
											<option value="refunded" @if ($setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='refunded' ) selected @endif @endforeach
											@endif
												 @endif >Refunded</option>
											<option value="failed" @if ($setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='failed' ) selected @endif @endforeach
											@endif
												 @endif >Failed</option> @endif </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 mt-4">
								<div class="form-group">
									<label for="Expiry time" class="mb-0">Expiry time</label>
									<select id="expiry_time" name="expiry_time" class="form-control form-select" data-search="on">
										<option value="300000" @if ($setting !=null) @if ( '300000'==$setting->expiry_time) selected @endif @endif>5 Minutes</option>
										<option value="600000" @if ($setting !=null) @if ( '600000'==$setting->expiry_time) selected @endif @endif>10 Minutes</option>
										<option value="900000" @if ($setting !=null) @if ( '900000'==$setting->expiry_time) selected @endif @endif>15 Minutes</option>
										<option value="1200000" @if ($setting !=null) @if ( '1200000'==$setting->expiry_time) selected @endif @endif>20 Minutes</option>
										<option value="1500000" @if ($setting !=null) @if ( '1500000'==$setting->expiry_time) selected @endif @endif>25 Minutes</option>
										<option value="1800000" @if ($setting !=null) @if ( '1800000'==$setting->expiry_time) selected @endif @endif>30 Minutes</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6 d-flex mt-5 ">
								<div class="form-group mb-0 ">
									<label class="btn img-lbl border p-1 mb-0">Upload Logo
										<input type="file" style="display: none;" name="logo" onchange="readURL(this);">
									</label>
								</div>
								<div class="image-div ml-3"> @if (isset($setting)) <img id="blah" src="{{ asset('uploads/logo/'.$setting->logo) }}" class="rounded-circle" alt="No Logo Found" width="80px" height="80px"> @else <img id="blah" src="" class="rounded-circle" alt="No Logo Found" width="80px" height="80px"> @endif </div>
							</div>
						</div>
						<div class="col-sm-12 ">
							<div class="form-group mt-3 float-right">
								<button class="btn btn-dim btn-primary ">Update Setting</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- .card-inner -->
		</div>
		<!-- .nk-ecwg -->
	</div>
	<!-- .card -->
</div> @endsection @section('script')
<script>
function readURL(input) {
	if(input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#blah').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
</script> @endsection