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
					<form action="" method="post" class="col-sm-12"> @csrf
						<div class="d-flex">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="" class="mb-0">Select Store</label>
									<div class="form-control-wrap">
										<select class="form-select form-control form-control-lg" id="stores" name="store" data-search="on">
											<option value="default_option">Choose store</option>
											@if (isset($shops))
												
											@foreach ($shops as $shop) @if (Auth::user()->id == $shop->user_id)
										   <option class="text-capitalize" value="{{ $shop->id }}" @if ($setting !=null) {{ ($shop->id == $setting->shop_id) ? "selected":'' }} @endif> {{ $shop->name }}</option> @endif @endforeach 
											@endif
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="filter By Status" class="mb-0">Filter Status</label>
									<select id="order_status" name="order_status" class="form-control form-select" data-search="on">
										@if (isset($seeting))
										<option value="all" @if ($setting !=null) @if ( 'all'==$setting->order_status) selected @endif @endif >All</option>
										<option value="pending" @if ($setting !=null) @if ( 'pending'==$setting->order_status) selected @endif @endif >Pending payment</option>
										<option value="processing" @if ($setting !=null) @if ( 'processing'==$setting->order_status) selected @endif @endif >Processing</option>
										<option value="on-hold" @if ($setting !=null) @if ( 'on-hold'==$setting->order_status) selected @endif @endif >On hold</option>
										<option value="completed" @if ($setting !=null) @if ( 'completed'==$setting->order_status) selected @endif @endif >Completed</option>
										<option value="cancelled" @if ($setting !=null) @if ( 'cancelled'==$setting->order_status) selected @endif @endif >Cancelled</option>
										<option value="refunded" @if ($setting !=null) @if ( 'refunded'==$setting->order_status) selected @endif @endif >Refunded</option>
										<option value="failed" @if ($setting !=null) @if ( 'failed'==$setting->order_status) selected @endif @endif >Failed</option>
										@endif
									</select>
								</div>
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
</div> @endsection