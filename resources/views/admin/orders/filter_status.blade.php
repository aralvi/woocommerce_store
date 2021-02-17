  @if (isset($orders))
                            
                        @foreach ($orders as $order)

                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                    <input type="checkbox" name="" class="order_check ">
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-info">
                                    <span class="tb-lead">{{ $order->id }}<span
                                            class="dot dot-success d-md-none ml-1"></span></span>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-info">
                                    <form action="{{ route('orders.show',$order->id) }}" >
                                <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                                <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                                <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                                <button type="submit" class="btn btn-dim text-primary text-left">{{ $order->billing->first_name. " ".  $order->billing->last_name }}</button>
                                </form>
                                    {{-- <a href="{{ route('orders.show',$order->id) }}" >{{ $order->billing->first_name. " ".  $order->billing->last_name }} --}}
                                        {{-- </a> --}}
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-mb">
                                <span class="tb-amount">{{ $order->status }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{$order->date_created}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                {{ $order->total }}
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                {{ count($order->line_items) }}
                            </td>
                            
                            <td class="nk-tb-col tb-col-md">
                                <form action="{{ route('orders.show',$order->id) }}" >
                                <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                                <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                                <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                                <button type="submit" class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></button>
                                </form>
                                {{-- <a href="{{ route('orders.show',$order->id) }}" class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a> --}}
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