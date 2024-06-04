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
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="mx-2" for="input_type">Filter</label>
                                                <select class="mx-2 form-control" id="input_type">
                                                    <option disabled>Tipe Input</option>
                                                    @foreach ($data_type as $type)
                                                        <option {{ $type->id_type_input == 1 ? 'selected' : '' }}
                                                            value="{{ $type->id_type_input }}">{{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
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
                                            <thead class="table-primary">
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
    {{-- <script src="../app-assets/js/scripts/charts/chartjs/line/line.js" type="text/javascript"></script> --}}
    <script>
        $(document).ready(function() {
            getChart(1);

            function getChart(filter) {
                $.ajax({
                    url: "{{ url('/get-data-all/') }}/" + filter,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var labels = [];
                        var yData = [];

                        // Mengambil data x dan y dari setiap entri dalam respons AJAX
                        response.forEach(function(entry) {
                            labels.push(entry.x);
                            yData.push(entry.y);
                        });
                        createChart(labels, yData);
                    },
                    error: function(xhr, status, error) {
                        console.error(
                            error);
                    }
                });
            };
            $('#table_data').DataTable({
                processing: true,
                serverSide: false,
                dom: "lrtip",
                ajax: {
                    url: "{{ url('/get-data-all/1') }}",
                    type: 'GET',
                    dataSrc: ''
                },
                columns: [{
                        data: null,
                        className: 'ps-4',
                        render: function(data, type, full, meta) {

                            var tbody =
                                '<div class="d-flex flex-column justify-content-center">' +
                                '<h6 class="mb-0 text-sm">' + (meta.row + 1) + '</h6>' +
                                '</div>';
                            return tbody;
                        },
                    },
                    {
                        data: 'x',
                        className: 'ps-4',
                        render: function(data) {

                            var tbody =
                                '<div class="d-flex flex-column justify-content-center">' +
                                '<h6 class="mb-0 text-sm">' + data + '</h6>' +
                                '</div>';
                            return tbody;
                        },
                    },
                    {
                        data: 'y',
                        className: 'ps-4',
                        render: function(data) {

                            var tbody =
                                '<div class="d-flex flex-column justify-content-center">' +
                                '<h6 class="mb-0 text-sm">' + data + '</h6>' +
                                '</div>';
                            return tbody;
                        },
                    },
                    {
                        data: null,
                        className: 'ps-4',
                        render: function(data, type, full, meta) {
                            // Menambahkan nomor urut
                            var tbody =
                                '<div class="d-flex flex-column justify-content-center">' +
                                '<h6 class="mb-0 text-sm">' + data.x * data.x + '</h6>' +
                                '</div>';
                            return tbody;
                        },
                    },
                    {
                        data: null,
                        className: 'ps-4',
                        render: function(data, type, full, meta) {
                            // Menambahkan nomor urut
                            var tbody =
                                '<div class="d-flex flex-column justify-content-center">' +
                                '<h6 class="mb-0 text-sm">' + data.y * data.y + '</h6>' +
                                '</div>';
                            return tbody;
                        },
                    },
                    {
                        data: null,
                        className: 'ps-4',
                        render: function(data, type, full, meta) {
                            // Menambahkan nomor urut
                            var tbody =
                                '<div class="d-flex flex-column justify-content-center">' +
                                '<h6 class="mb-0 text-sm">' + data.x * data.y + '</h6>' +
                                '</div>';
                            return tbody;
                        },
                    },
                ],
            });
            $('#input_type').on('change', function() {
                var url = '/get-data-all/' + $(this).val();
                getChart($(this).val());
                $('#table_data').DataTable().ajax.url(url).load();
            });

            function createChart(labels, data) {
                var ctx = $("#line-chart");

                var chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                    },
                    hover: {
                        mode: 'label'
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                color: "#f3f3f3",
                                drawTicks: false,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'X'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                color: "#f3f3f3",
                                drawTicks: false,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Y'
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Grafik Data'
                    }
                };

                var chartData = {
                    labels: labels,
                    datasets: [{
                        label: "Grafik Regresi Linear",
                        data: data,
                        lineTension: 0,
                        fill: false,
                        borderColor: "#FF7D4D",
                        pointBorderColor: "#FF7D4D",
                        pointBackgroundColor: "#FFF",
                        pointBorderWidth: 2,
                        pointHoverBorderWidth: 2,
                        pointRadius: 4,
                    }]
                };

                var config = {
                    type: 'line',
                    options: chartOptions,
                    data: chartData
                };

                // Membuat grafik menggunakan data dan konfigurasi yang diberikan
                var lineChart = new Chart(ctx, config);
            }
        });
    </script>
@endpush
