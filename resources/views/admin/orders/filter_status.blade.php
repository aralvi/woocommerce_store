 @foreach ($orders as $order)

                                <tr>
                                    <td><input type="checkbox" name="" id=""></td>
                                    <td>{{ $order->order_key }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="w-296">
                                        {{$order->date_created}}
                                    </td>
                                    <td>{{ $order->total }}</td>
                                    <td></td>
                                    <td>{{ count($order->line_items) }}</td>
                                    <td><a href="{{ route('orders.show',$order->id) }}">view more</a> </td>
                                </tr>
                                @endforeach