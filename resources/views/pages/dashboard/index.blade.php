@extends('layout.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2">
                    <h3 class="content-header-title mb-0 d-inline-block">
                        Dashboard
                    </h3>
                </div>
            </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="card-content collapse show">
                                                    <div class="card-body chartjs">
                                                        <div class="height-300">
                                                            <canvas id="line-chart"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="table_data" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>X</th>
                                                    <th>Y</th>
                                                    <th>X<sup>2</sup></th>
                                                    <th>Y<sup>2</sup></th>
                                                    <th>XY</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>0.75</td>
                                                    <td>176</td>
                                                    <td>0.5625</td>
                                                    <td>30976</td>
                                                    <td>132</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>0.75</td>
                                                    <td>176</td>
                                                    <td>0.5625</td>
                                                    <td>30976</td>
                                                    <td>132</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>0.75</td>
                                                    <td>176</td>
                                                    <td>0.5625</td>
                                                    <td>30976</td>
                                                    <td>132</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>0.75</td>
                                                    <td>176</td>
                                                    <td>0.5625</td>
                                                    <td>30976</td>
                                                    <td>132</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/datatables.min.css" />
@endpush
@push('scripts')
    <script src="../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <script src="../app-assets/js/scripts/charts/chartjs/line/line.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#table_data').DataTable();
        });
    </script>
@endpush
