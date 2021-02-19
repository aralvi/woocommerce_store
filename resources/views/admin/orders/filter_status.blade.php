  <div class="d-flex justify-content-center">
      <div class="spinner-border text-primary d-none" id="loading" role="status">
          <span class="sr-only"></span>
      </div>
  </div>
  <table class="datatable-init nowrap nk-tb-list is-separate dataTable no-footer mt-5" data-auto-responsive="false">
      <thead class="thead-dark">
          <tr class="nk-tb-item nk-tb-head">
              <th class="nk-tb-col nk-tb-col-check">
                  <div class="custom-control custom-control-sm custom-checkbox notext">
                      <input type="checkbox" class="custom-control-input" id="uid1">
                      <label class="custom-control-label" for="uid1"></label>
                  </div>
                  {{-- <input type="checkbox" name="" class=" " id="orders_check"> --}}
              </th>
              <th class="nk-tb-col">Order# </th>
              <th class="nk-tb-col">Customer </th>
              <th class="nk-tb-col tb-col-mb">Status</th>
              <th class="nk-tb-col tb-col-md">Date</th>
              <th class="nk-tb-col tb-col-lg">Total</th>
              <th class="nk-tb-col tb-col-lg">Tracking</th>
              <th class="nk-tb-col tb-col-md">Itmes</th>
              {{-- <th class="nk-tb-col tb-col-md">Curior</th> --}}
              <th class="nk-tb-col tb-col-md">Action</th>

          </tr>
      </thead>
      <tbody id="order_table">
          @if (isset($orders))

          @foreach ($orders as $count => $order)

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
                      <form action="{{ route('orders.show',$order->id) }}">
                          <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                          <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                          <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                          <button type="submit"
                              class="btn btn-dim text-primary text-left">{{ $order->id }}</button>
                      </form>
                      {{-- <span class="tb-lead">{{ $order->id }}<span class="dot dot-success d-md-none ml-1"></span></span> --}}
                  </div>
              </td>
              <td class="nk-tb-col">
                  <div class="user-info">
                      <form action="{{ route('orders.show',$order->id) }}">
                          <input type="hidden" name="store_url" class="store_url" value="{{ $store_url }}">
                          <input type="hidden" name="consumer_key" class="consumer_key" value="{{ $key }}">
                          <input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ $secret }}">
                          <button type="submit"
                              class="btn btn-dim text-primary text-left">{{ $order->billing->first_name. " ".  $order->billing->last_name }}</button>
                      </form>
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
                  <li class="nk-tb-action-hidden list-unstyled d-flex">
                      <a href="{{ $store_url."/wp-admin/post.php?post=".$order->id."&action=edit " }}"
                          class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title=""
                          data-original-title="view at Woocommerce">
                          <em class="icon ni ni-eye"></em>
                      </a>
                      <div class="drodown mr-n1">
                          <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                  class="icon ni ni-more-h"></em></a>
                          <div class="dropdown-menu dropdown-menu-right">
                              <ul class="link-list-opt no-bdr">
                                  <li>
                                      <form action="{{ route('orders.show',$order->id) }}">
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
                                          {{-- <button type="submit" class="btn btn-sm btn-dim btn-primary"><i
                            class="icon ni ni-eye"></i></button> --}}
                                      </form>
                                  </li>
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

      </tbody>
  </table>


  <script>
      function getOrderList() {
          $('#orderStatus').find('#appended_section').remove();
          var cars = [];
          $.each($('.order_check'), function () {
              if ($(this).is(':checked')) {
                  cars.push($(this).val());

              }
          });
          var key = $('.consumer_key').val();
          var store_url = $('.store_url').val();
          var secret = $('.consumer_secret').val();
          let ht = '<div id="appended_section"></div><input type="hidden" id="order_list" name="order_list" value="' +
              cars + '"/><input type="hidden" id="key" name="key" value="' + key +
              '"/><input type="hidden" id="store_url" name="store_url" value="' + store_url +
              '"/><input type="hidden" id="secret" name="secret" value="' + secret + '"/></div>';
          $('#orderStatus').append(ht);
      }
      $('#update_Status').on('click', function () {
          if ($('#order_list').val() == '') {
              $('#lblStatus').html('Please check Atleast one order ').css({
                  'display': 'block',
                  'color': 'red'
              });
              return false
          } else {
              $('#lblStatus').css({
                  'display': 'none'
              });
          }
          if ($('#change_order_status').val() == null) {
              $('#lblStatus').html('Please select  atleast one option ').css({
                  'display': 'block',
                  'color': 'red'
              });
              return false
          } else {
              $('#lblStatus').css({
                  'display': 'none'
              });
          }
      })
      $("#uid1").click(function () {
          var cars = [];
          if ($(this).is(':checked')) {
              $('.order_check').attr('checked', 'checked');
              $.each($('.order_check'), function () {
                  if ($(this).is(':checked')) {
                      cars.push($(this).val());

                  }

              });
          } else {
              $('.order_check').removeAttr('checked', 'checked');

          }
      });

  </script>
