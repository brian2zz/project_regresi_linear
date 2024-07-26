@extends('layout.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2">
                    <h3 class="content-header-title mb-0 d-inline-block">
                        Hasil Forecasting
                    </h3>
                </div>
            </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div id="form_input" class="row d-flex justify-content-center">
                                            <div class="col-sm-12 col-md-12">

                                                <div class="table-responsive">
                                                    <table id="table_input" class="table table-bordered">
                                                        <thead class="table-primary">
                                                            <tr class="text-center">
                                                                <th>Luas Lahan</th>
                                                                <th>Jenis</th>
                                                                <th>Hasil</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="text-center">

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item" id="li_prev"><a class="page-link"
                                                                href="#" id="page_prev">Previous</a></li>
                                                        <li class="page-item disabled">
                                                            <a class="page-link" href="#" id="current_page">1</a>
                                                        </li>
                                                        <li class="page-item" id="li_next"><a class="page-link"
                                                                href="#" id="page_next">Next</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
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
    <script src="../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
    <script src="../app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            let page = 1;
            let totalPage = 1;
            get_data(page);

            function get_data(page) {
                fetch(`/get-history-forecasting?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        var tableBody = document.getElementById('table_body');
                        tableBody.innerHTML = '';
                        data.data.forEach(input => {
                            var newRow = document.createElement('tr');
                            newRow.innerHTML = `
                                <td>${input.luas_lahan}</td>
                                <td>${input.type.name}</td>
                                <td>${input.hasil}</td>
                             `
                            tableBody.appendChild(newRow);
                        })
                        totalPage = data.totalPage;
                        $('#current_page').text(page);
                        $("#li_prev").toggleClass("disabled", data.previousPageUrl === null);
                        $("#li_next").toggleClass("disabled", data.nextPageUrl === null);
                    }).catch(error => console.error('Error:', error));
            }
            $('#page_next').click(function(e) {
                let li = $(this).closest('li').hasClass('disabled');
                if (!li && page < totalPage) {
                    page++;
                    get_data(page);
                }
            });
            $('#page_prev').click(function(e) {
                let li = $(this).closest('li').hasClass('disabled');
                console.log(page)
                console.log(totalPage)
                console.log(li)
                if (!li && page <= totalPage) {
                    page--;
                    get_data(page);
                }
            });

        });
    </script>
@endpush
