@extends('layout.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2">
                    <h3 class="content-header-title mb-0 d-inline-block">
                        {{ $type == 1 ? 'Urea' : 'Phonska' }}
                    </h3>
                </div>
            </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">

                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        {{-- <div class="row d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-4 mb-2">
                                                <select class="form-control" id="input_type">
                                                    <option disabled>Tipe Input</option>
                                                    @foreach ($data_type as $type)
                                                        <option {{ $type->id_type_input == 1 ? 'selected' : '' }}
                                                            value="{{ $type->id_type_input }}">{{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div id="form_input" class="row d-flex justify-content-center">
                                            <div class="col-sm-12 col-md-12">

                                                <input type="hidden" name="id_type" id="id_type"
                                                    value="{{ $type }}">
                                                <div class="table-responsive">
                                                    <table id="table_input" class="table table-bordered">
                                                        <thead class="table-primary">
                                                            <tr class="text-center">
                                                                <th>Input X (Luas Lahan)</th>
                                                                <th>Input Y ({{ $type == 1 ? 'Urea' : 'Phonska' }})</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body">

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
                                                <div class="d-flex justify-content-end mt-1">
                                                    <button onClick="addrow(event)" class="btn btn-primary mx-2">
                                                        Add
                                                    </button>
                                                    <button onclick="handleSave()"
                                                        class="btn bg-success bg-darken-4 text-white">
                                                        Simpan
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-12">
                                                <h3>
                                                    Keterangan:
                                                </h3>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="table_ket">

                                                    </table>
                                                </div>
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
            data_input({{ $type }}, page);
            data_ket({{ $type }});

            function data_ket(input_type) {
                fetch(`/get-ket?jenis=${input_type}`)
                    .then(response => response.json())
                    .then(data => {

                        $('#table_ket').append(
                            `
                            <tr>
                                <td>N</td>
                                <td>${data.n}</td>
                            </tr>
                            <tr>
                                <td>Total X</td>
                                <td>${data.total_x.toFixed(2)}</td>
                            </tr>
                            <tr>
                                <td>Total Y</td>
                                <td>${data.total_y.toFixed(2)}</td>
                            </tr>
                            <tr>
                                <td>Rata - rata X</td>
                                <td>${data.a}</td>
                            </tr>
                            <tr>
                                <td>Rata - rata y</td>
                                <td>${data.b}</td>
                            </tr>
                            <tr>
                                <td>Persamaan</td>
                                <td>${data.a} * ${data.b}</td>
                            </tr>`
                        )
                    })
                    .catch(error => console.error(error));
            }

            function data_input(input_type, page) {
                fetch(`/get-data/${input_type}?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        var tableBody = document.getElementById('table_body');
                        tableBody.innerHTML = '';
                        data.data.forEach(input => {

                            var newRow = document.createElement('tr');
                            newRow.innerHTML = `
                    <td><input type="number" step="any" class="form-control" onChange="changeValue(this, ${input.id})" id="input_x_${input.id}" value="${input.x}" name="input_x[]"></td>
                    <td>
                        <input type="number" step="any" class="form-control" onChange="changeValue(this, ${input.id})" value="${input.y}" id="input_y_${input.id}" name="input_y[]">
                        <input type="hidden" step="any" class="form-control" value="update" id="status_${input.id}" name="status[]">
                    </td>
                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm delete-row" onClick="delete_row(event,${input.id})">Delete</button></td>
                `;
                            tableBody.appendChild(newRow);
                        });
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
                    data_input({{ $type }}, page);
                }
            });
            $('#page_prev').click(function(e) {
                let li = $(this).closest('li').hasClass('disabled');
                if (!li && page < totalPage) {
                    page--;
                    data_input({{ $type }}, page);
                }
            });

            // document.getElementById('input_type').addEventListener('change', function() {
            //     var selectedValue = this.value;

            //     var selectedText = this.options[this.selectedIndex].textContent;
            //     var formInput = document.getElementById('form_input');
            //     var colToRemove = formInput.querySelector('.col-sm-12.col-md-6');
            //     if (colToRemove) {
            //         colToRemove.parentNode.removeChild(colToRemove);
            //     }

            //     var htmlElement = `
        //         <div class="col-sm-12 col-md-6">
        //             <form action="" method="post">
        //                 @csrf
        //                 <input type="hidden" name="id_type" value="${selectedValue}">
        //                 <div class="table-responsive">
        //                     <table id="table_input" class="table table-bordered">
        //                         <thead class="table-primary">
        //                             <tr class="text-center">
        //                                 <th width="20px">Input X (Luas Lahan)</th>
        //                                 <th width="20px">Input Y (${selectedText})</th>
        //                                 <th width="20px">Action</th>
        //                             </tr>
        //                         </thead>
        //                         <tbody id="table_body">

        //                         </tbody>
        //                     </table>
        //                 </div>
        //                 <div class="d-flex justify-content-end">
        //                     <button type="button" onClick="addrow(event)" class="btn btn-primary mx-2">
        //                         Add
        //                     </button>
        //                     <button type="submit" class="btn bg-success bg-darken-4 text-white">
        //                         Simpan
        //                     </button>
        //                 </div>
        //             </form>
        //         </div>
        //     `;
            //     formInput.innerHTML += htmlElement;
            //     data_input(selectedValue);

            // });



        });
    </script>
    <script>
        var update_data = []

        function changeValue(inputElement, id) {
            var value = inputElement.value;
            var data = {
                id: id,
                input_x: $(`#input_x_${id}`).val(),
                input_y: $(`#input_y_${id}`).val(),
                status: $(`#status_${id}`).val(),
            }
            console.log(data)
            var existingIndex = update_data.findIndex(item => item.id === id);

            if (existingIndex !== -1) {
                // Jika ada id yang sama, hapus data yang lama
                update_data.splice(existingIndex, 1);
            }

            // Tambahkan data yang baru
            update_data.push(data);

            console.log(update_data);
        }

        function addrow(event) {
            event.preventDefault();
            var tbody = document.querySelector('#table_input tbody');
            var newRow = document.createElement('tr');
            var id = Date.now()
            newRow.innerHTML = `
                    <td><input type="number" step="any" class="form-control" onChange="changeValue(this, ${id})" id="input_x_${id}" name="input_x[]"></td>
                    <td>
                        <input type="number" step="any" class="form-control" onChange="changeValue(this, ${id})" id="input_y_${id}" name="input_y[]">
                        <input type="hidden" step="any" class="form-control" value="new" id="status_${id}" name="status[]">
                    </td>
                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm delete-row" onClick="delete_row(event,${id})">Delete</button></td>
                `;

            tbody.appendChild(newRow);
        };

        function delete_row(event, id) {
            var status = $(`#status_${id}`).val();
            console.log(status)
            var data = {}
            if (status === "update") {
                data = {
                    id: id,
                    input_x: $(`#input_x_${id}`).val(),
                    input_y: $(`#input_y_${id}`).val(),
                    status: "delete",
                }
                update_data.push(data);
            }
            if (event.target.classList.contains('delete-row')) {
                var rowToDelete = event.target.closest('tr');
                rowToDelete.remove();
            }
        };


        function handleSave() {
            var postData = {
                update_data: update_data
            };
            var type = $("#id_type").val();
            console.log(type);
            $.ajax({
                url: '/phonska?type=' + type, // Ganti dengan URL endpoint server Anda
                type: 'POST',
                data: JSON.stringify(postData),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                success: function(response) {
                    console.log('Data successfully sent:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);
                }
            });
        }
    </script>
@endpush
