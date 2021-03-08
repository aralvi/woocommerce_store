
          @if (isset($orders))

          @foreach ($orders as $count => $order)
            @php
              $consignment = App\Consignment::where('order_id',$order->id)->first();
            @endphp
            <tr class="nk-tb-item">
                <td class="nk-tb-col nk-tb-col-check">
                    <div class="custom-control custom-control-sm custom-checkbox notext">
                        <input type="checkbox" class="custom-control-input order_check" id="uid{{ $count+2 }}"
                            value="{{ $order->id }}">
                        <label class="custom-control-label order_check" for="uid{{ $count+2}}"></label>
                    </div>
                    {{-- <input type="checkbox" name="" class="order_check " value="{{ $order->id }}"> --}}
                </td>
                <td class="nk-tb-col">
                    <div class="user-info">
                        {{-- <form action="{{ route('orders.show',$order->id) }}">
                            <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                            <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                            <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                            <button type="submit"
                                class="btn btn-dim text-primary text-left">{{ $order->id }}</button>
                        </form> --}}
                        {{-- <span class="tb-lead">{{ $order->id }}<span class="dot dot-success d-md-none ml-1"></span></span> --}}
                         <a href="{{ route('orders.show',$order->id) }}?store={{ encrypt($order->shop_id) }}" target="_blank">{{ $order->id }}</a>
                    </div>
                </td>
                <td class="nk-tb-col">
                    <div class="user-info">
                        {{-- <form action="{{ route('orders.show',$order->id) }}">
                            <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                            <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                            <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                            <button type="submit"
                                class="btn btn-dim text-primary text-left">{{ $order->customer }}</button>
                        </form> --}}
                         <a href="{{ route('orders.show',$order->id) }}?store={{ encrypt($order->shop_id) }}" target="_blank">{{ $order->customer }}
                    </div>
                </td>
                <td class="nk-tb-col tb-col-mb">
                    @if ($order->status == 'on-hold')
                    <span class="dot bg-warning d-mb-none"></span>
                    <span
                        class="badge badge-sm badge-dot has-bg badge-warning d-none d-mb-inline-flex">{{ $order->status }}</span>
                    @endif
                    @if ($order->status == 'completed')
                    <span class="dot bg-success d-mb-none"></span>
                    <span
                        class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">{{ $order->status }}</span>
                    @endif
                    @if ($order->status == 'failed')
                    <span class="dot bg-danger d-mb-none"></span>
                    <span
                        class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                    @endif
                    @if ($order->status == 'pending')
                    <span class="dot bg-info d-mb-none"></span>
                    <span
                        class="badge badge-sm badge-dot has-bg badge-info d-none d-mb-inline-flex">{{ $order->status }}</span>
                    @endif
                    @if ($order->status == 'processing')
                    <span class="dot bg-primary d-mb-none"></span>
                    <span
                        class="badge badge-sm badge-dot has-bg badge-primary d-none d-mb-inline-flex">{{ $order->status }}</span>
                    @endif
                    @if ($order->status == 'refunded')
                    <span class="dot bg-secondary d-mb-none"></span>
                    <span
                        class="badge badge-sm badge-dot has-bg badge-secondary d-none d-mb-inline-flex">{{ $order->status }}</span>
                    @endif
                    @if ($order->status == 'cancelled')
                    <span class="dot bg-danger d-mb-none"></span>
                    <span
                        class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                    @endif
                    {{-- <span class="tb-amount">{{ $order->status }}</span> --}}
                </td>
                <td class="nk-tb-col tb-col-md">
                    <span>{{$order->date}}</span>
                </td>
                <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                    {{ $order->total }}
                </td>
                <td class="nk-tb-col tb-col-lg">
                    {{ $order->items }}
                </td>

                <td class="nk-tb-col tb-col-md">
                    <li class="nk-tb-action-hidden list-unstyled d-flex">
                        <a href="{{ $store_url."/wp-admin/post.php?post=".$order->id."&action=edit " }}" target="_blank"
                            class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title=""
                            data-original-title="view at Woocommerce">
                            <em class="icon ni ni-eye"></em>
                        </a>
                        <div class="drodown mr-n1">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                    class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    {{-- <li>
                                        <form action="{{ route('orders.show',$order->id) }}?store={{ encrypt($order->shop_id) }}" target="_blank">
                                            <input type="hidden" name="store_url" class="store_url"
                                                value="{{ $store_url }}">
                                            <input type="hidden" name="consumer_key" class="consumer_key"
                                                value="{{ $key }}">
                                            <input type="hidden" name="consumer_secret" class="consumer_secret"
                                                value="{{ $secret }}">
                                            <button type="submit" class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="View Detail">
                                                <em class="icon ni ni-eye"></em><span class="text-primary">Order Detail</span>
                                            </button>
                                            
                                        </form>
                                    </li> --}}
                                    <li>
                                                                            <a href="{{ route('orders.show',$order->id) }}?store={{ encrypt($order->shop_id) }}" target="_blank">
                                                                                <em class="icon ni ni-eye"></em>
                                                                                <span>Order Details</span>
                                                                            </a>
                                                                        </li>

                                    @if(!$consignment && $order->tracking_link ==null)

                                      <li>
                                            <a href="{{ route('add.consignment',$order->id) }}">
                                                <em class="icon ni ni-eye"></em>
                                                <span>Add Consignment</span>
                                            </a>
                                      </li>

                                    @endif

                                    @if($consignment && $order->tracking_link == null)

                                        <li>
                                            <a type="button" data-toggle="modal"
                                                onclick="orderSetting(this,{{ $order->id }},'{{ $consignment->label_number }}');"
                                                data-target="#addTrackingInfo">
                                                <em class="icon ni ni-eye"></em>
                                                <span>Add Tracking</span>
                                            </a>
                                        </li>

                                    @endif

                                    
                                    @if($order->tracking_link !=null)
                                        <li>
                                            <a href="{{ $order->tracking_link }}" target="_blank">
                                                <em class="icon ni ni-eye"></em>
                                                <span>Order Tracking</span>
                                            </a>
                                        </li>
                                    @endif
                                        
                                </ul>
                            </div>
                        </div>

                    </li>

                    {{-- <a href="{{ route('orders.show',$order->id) }}" class="btn btn-sm btn-dim btn-primary"><i
                        class="icon ni ni-eye"></i></a> --}}
                </td>

            </tr><!-- .nk-tb-item  -->
          @endforeach

          <tr>
              <td>

                  <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                  <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                  <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
              </td>
          </tr>
          @endif
