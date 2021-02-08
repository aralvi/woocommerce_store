@extends('layouts.admin') @section('title','dashboard') @section('page-title','Order Preparation') @section('content')

<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group bg-gray mb-5">
                    <div class="form-group col-xxl-3 col-sm-3 m-0">
                        <div class="col-xxl-12 col-sm-12 p-0 m-0">
                            <label for="">Operator</label>
                            <select name="" id="">
                                <option value="">option1</option>
                                <option value="">option1</option>
                                <option value="">option1</option>
                            </select>
                        </div>
                        <div class="col-xxl-12 col-sm-12 p-0 m-0">
                            <label for="">warehouse</label>
                            <select name="" id="">
                                <option value="">option1</option>
                                <option value="">option1</option>
                                <option value="">option1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xxl-9 col-sm-9">
                        <button class="btn btn-md btn-warning">1. Order Selection</button>
                        <button class="btn btn-md btn-warning">2. Picking</button>
                        <button class="btn btn-md btn-warning">3. Packing</button>
                        <button class="btn btn-md btn-warning">4. Download PDFs</button>
                        <button class="btn btn-md btn-warning">5. Shipping</button>
                        <button class="btn btn-md btn-warning">6. Flush shipped orders</button>
                    </div>
                </div>
                {{-- card header section end --}}

                <div class="data px-2">
                    {{-- card tabs --}}
                    <div class="col-xxl-12 col-sm-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active tab-link border-left border-right" id="pills-stock-tab" data-toggle="pill" href="#pills-stock" role="tab" aria-controls="pills-stock" aria-selected="true">In Stock</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link border-left border-right" id="pills-backorder-tab" data-toggle="pill" href="#pills-backorder" role="tab" aria-controls="pills-backorder" aria-selected="false">Backorder</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link border-left border-right" id="pills-hold-tab" data-toggle="pill" href="#pills-hold" role="tab" aria-controls="pills-hold" aria-selected="false">On Hold</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link border-left border-right" id="pills-progress-tab" data-toggle="pill" href="#pills-progress" role="tab" aria-controls="pills-progress" aria-selected="false">In Progress</a>
                            </li>
                        </ul>
                    </div>
                    {{-- card tabs end --}}

                    <div class="mb-2">
                        <button class="btn btn-md btn-secondary">Search</button>
                        <button class="btn btn-md bg-none border-0 text-primary">Reset Filter</button>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="col-xxl-6 col-sm-6 p-0">
                            <select name="" id="">
                                <option value="">Actions</option>
                                <option value="">Prepare</option>
                            </select>
                        </div>
                        <div class="col-xxl-6 col-sm-6 p-0 d-flex justify-content-around">
                            <select name="" id="">
                                <option value="">Actions</option>
                                <option value="">Prepare</option>
                            </select>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    {{-- card tabs content --}}
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-stock" role="tabpanel" aria-labelledby="pills-stock-tab">
                            <div class="data-group table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">
                                                <select name="" id="">
                                                    <option value=""></option>
                                                    <option value="">Select All</option>
                                                    <option value="">Unselect All</option>
                                                    <option value="">Select visible all</option>
                                                    <option value="">Unselect visible All</option>
                                                </select>
                                            </th>
                                            <th scope="col">#</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">store</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Shipping method</th>
                                            <th scope="col">Products</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <select name="" id="">
                                                    <option value="">Any</option>
                                                </select>
                                            </th>
                                            <td><input type="text" /></td>
                                            <td><input type="text" /></td>
                                            <td><input type="text" /></td>
                                            <td><input type="text" /></td>
                                            <td><input type="text" /></td>
                                            <td><input type="text" /></td>
                                            <td><input type="text" /></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th><input type="checkbox" name="" id="" /></th>
                                            <td>000000009</td>
                                            <td>Feb 8 2021, 04:05:15 PM</td>
                                            <td>Processing</td>
                                            <td>
                                                Main Website <br />
                                                &nbsp; Main Website Store <br />
                                                &nbsp;&nbsp; Default Store view
                                            </td>
                                            <td>Marion Anston</td>
                                            <td>Flat Rate - Fixed</td>
                                            <td class="text-success">1x echo - Amazon echo dot</td>
                                            <td><a href=""> View Prepare</a></td>
                                        </tr>
                                        <tr>
                                            <th><input type="checkbox" name="" id="" /></th>
                                            <td>000000009</td>
                                            <td>Feb 8 2021, 04:05:15 PM</td>
                                            <td>Processing</td>
                                            <td>
                                                Main Website <br />
                                                &nbsp; Main Website Store <br />
                                                &nbsp;&nbsp; Default Store view
                                            </td>
                                            <td>Marion Anston</td>
                                            <td>Flat Rate - Fixed</td>
                                            <td class="text-success">1x echo - Amazon echo dot</td>
                                            <td><a href=""> View Prepare</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-backorder" role="tabpanel" aria-labelledby="pills-backorder-tab">
                            <div class="data-group">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-hold" role="tabpanel" aria-labelledby="pills-hold-tab">
                            <div class="data-group">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-progress" role="tabpanel" aria-labelledby="pills-progress-tab">
                            <div class="data-group">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- card tabs content end --}}
                </div>
            </div>
            <!-- .card-inner -->
        </div>
        <!-- .nk-ecwg -->
    </div>
    <!-- .card -->
</div>
@endsection
