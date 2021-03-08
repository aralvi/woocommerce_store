@extends('layouts.admin') @section('title','store_setting') @section('page-title','store_setting') @section('content')
<div class="col-xxl-12 col-sm-12">
	<div class="card">
		<div class="nk-ecwg nk-ecwg6">
			<div class="card-inner"> {{-- card header section --}}
				<div class="card-title-group mb-3">
					<h4>
                        Update store_setting
                    </h4> </div>
				<div class="row gy-4">
					<form action="" method="post" class="col-sm-12" enctype="multipart/form-data"> @csrf
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="filter By Status" class="mb-0">Filter Status</label>
									<select id="order_status" name="order_status" class="form-control form-select" data-search="on"> @if (isset($store_setting))
										<option value="all" @if ($store_setting !=null) @if ( 'all'==$store_setting->order_status) selected @endif @endif >All</option>
										<option value="pending" @if ($store_setting !=null) @if ( 'pending'==$store_setting->order_status) selected @endif @endif >Pending payment</option>
										<option value="processing" @if ($store_setting !=null) @if ( 'processing'==$store_setting->order_status) selected @endif @endif >Processing</option>
										<option value="on-hold" @if ($store_setting !=null) @if ( 'on-hold'==$store_setting->order_status) selected @endif @endif >On hold</option>
										<option value="completed" @if ($store_setting !=null) @if ( 'completed'==$store_setting->order_status) selected @endif @endif >Completed</option>
										<option value="cancelled" @if ($store_setting !=null) @if ( 'cancelled'==$store_setting->order_status) selected @endif @endif >Cancelled</option>
										<option value="refunded" @if ($store_setting !=null) @if ( 'refunded'==$store_setting->order_status) selected @endif @endif >Refunded</option>
										<option value="failed" @if ($store_setting !=null) @if ( 'failed'==$store_setting->order_status) selected @endif @endif >Failed</option> @endif </select>
								</div>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="" class="mb-0">Exclude Status</label>
									<div class="form-control-wrap">
										<select class="form-select select2-hidden-accessible" id="excluded_status" name="excluded_status[]" multiple="" data-placeholder="Select Exclude Status" data-select2-id="9" tabindex="-1" aria-hidden="true"> @if (isset($store_setting)) @php 
											if (isset($store_setting->excluded_Status)) {
												$excluded_statuses = json_decode($store_setting->excluded_Status); 
											}
											@endphp
											<option value="pending" @if ($store_setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse == 'pending' ) selected @endif @endforeach
											@endif
											@endif >Pending payment</option>
											<option value="processing" @if ($store_setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='processing' ) selected @endif @endforeach
											@endif
											@endif >Processing</option>
											<option value="on-hold" @if ($store_setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='on-hold' ) selected @endif @endforeach
											@endif
											@endif >On hold</option>
											<option value="completed" @if ($store_setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='completed' ) selected @endif @endforeach
											@endif
											@endif >Completed</option>
											<option value="cancelled" @if ($store_setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='cancelled' ) selected @endif @endforeach
											@endif
											@endif >Cancelled</option>
											<option value="refunded" @if ($store_setting !=null) 
											@if(isset($excluded_statuses))
												
											@foreach($excluded_statuses as $key=> $excluded_statuse) @if ($excluded_statuse =='refunded' ) selected @endif @endforeach
											@endif
											@endif >Refunded</option>
											<option value="failed" @if ($store_setting !=null) 
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
									<select class="form-select select2-hidden-accessible" id="change_able_status" name="change_able_status[]" multiple="" data-placeholder="Select Changeable Status" data-select2-id="10" tabindex="-1" aria-hidden="true">@if (isset($store_setting)) 
										@php 
										if ($store_setting->change_able_Status) {
											$change_able_statuses = json_decode($store_setting->change_able_Status); 
										}
										@endphp
											<option value="pending" @if ($store_setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse == 'pending' ) selected @endif @endforeach
											@endif
												 @endif >Pending payment</option>
											<option value="processing" @if ($store_setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='processing' ) selected @endif @endforeach
											@endif
												 @endif >Processing</option>
											<option value="on-hold" @if ($store_setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='on-hold' ) selected @endif @endforeach
											@endif
												 @endif >On hold</option>
											<option value="completed" @if ($store_setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='completed' ) selected @endif @endforeach
											@endif
												 @endif >Completed</option>
											<option value="cancelled" @if ($store_setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='cancelled' ) selected @endif @endforeach
											@endif
												 @endif >Cancelled</option>
											<option value="refunded" @if ($store_setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='refunded' ) selected @endif @endforeach
											@endif
												 @endif >Refunded</option>
											<option value="failed" @if ($store_setting !=null) 
											@if (isset($change_able_statuses))
												
											@foreach($change_able_statuses as $key=> $change_able_statuse) @if ($change_able_statuse =='failed' ) selected @endif @endforeach
											@endif
												 @endif >Failed</option> @endif </select>
								</div>
							</div>
						</div>
						<div class="col-sm-12 ">
							<div class="form-group mt-3 float-right">
								<button class="btn btn-dim btn-primary ">Update store_setting</button>
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
</div> @endsection