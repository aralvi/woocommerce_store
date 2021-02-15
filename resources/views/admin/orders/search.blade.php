  @if (isset($orders))
                            
                        @foreach ($orders as $order)

                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" name="" class="order_check ">
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-info">
                                    <span class="tb-lead">{{ $order->id }}<span
                                            class="dot dot-success d-md-none ml-1"></span></span>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-info">
                                    <a href="{{ route('orders.show',$order->id) }}" >{{ $order->billing->first_name. " ".  $order->billing->last_name }}
                                        </a>
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
                            {{-- <td class="nk-tb-col tb-col-lg">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" data-search="on">
                                            <option value="default_option">Choose Curier service</option>
                                            <option value="option_select_name">TCS</option>
                                            <option value="option_select_name">Lepord</option>
                                        </select>
                                    </div>
                                </div>
                            </td> --}}
                            <td class="nk-tb-col tb-col-md">
                                <a href="{{ route('orders.show',$order->id) }}" class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a>
                                {{-- <button class="btn btn-sm btn-dim btn-primary order_status"
                                    data-orderId="{{ $order->id }}"><i class="icon ni ni-pen"></i></button>
                                    <button type="button" class="btn btn-sm btn-dim btn-primary orderNote" data-orderId="{{ $order->id }}"><i class="icon ni ni-plus"></i>Note</button>
                                    <form action="{{ route('ordernotes.index') }}" method="get">
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button type="subbmit" class="btn btn-sm btn-dim btn-primary" ><i class="icon ni ni-eye"></i> Note</button>
                                    </form> --}}
                            </td>

                        </tr><!-- .nk-tb-item  -->
                        @endforeach
                        @endif