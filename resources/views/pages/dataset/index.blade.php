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
                        <div class="col-12">
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
                                            <div class="col-sm-12 col-md-6">
                                                <form action="" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_type" value="{{ $type }}">
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
                                                    <div class="d-flex justify-content-end mt-1">
                                                        <button onClick="addrow(event)" class="btn btn-primary mx-2">
                                                            Add
                                                        </button>
                                                        <button class="btn bg-success bg-darken-4 text-white">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
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
            data_input({{ $type }});

            function data_input(input_type) {
                fetch('/get-data/' + input_type)
                    .then(response => response.json())
                    .then(data => {
                        var tableBody = document.getElementById('table_body');
                        tableBody.innerHTML = ''; // Clear previous table content
                        data.forEach(input => {
                            var newRow = document.createElement('tr');
                            newRow.innerHTML = `
                                <td><input type="number" step="any" class="form-control" value="${input.x}" name="input_x[]"></td>
                                <td><input type="number" step="any" class="form-control" value="${input.y}" name="input_y[]"></td>
                                <td class="text-center"><button type="button" class="btn btn-danger btn-sm delete-row" onClick="delete_row(event)">Delete</button></td>
                            `;
                            tableBody.appendChild(newRow);
                        });
                    }).catch(error => console.error('Error:', error));
            }
            document.getElementById('input_type').addEventListener('change', function() {
                var selectedValue = this.value;
                console.log(selectedValue);
                var selectedText = this.options[this.selectedIndex].textContent;
                var formInput = document.getElementById('form_input');
                var colToRemove = formInput.querySelector('.col-sm-12.col-md-6');
                if (colToRemove) {
                    colToRemove.parentNode.removeChild(colToRemove);
                }

                var htmlElement = `
                    <div class="col-sm-12 col-md-6">
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="id_type" value="${selectedValue}">
                            <div class="table-responsive">
                                <table id="table_input" class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr class="text-center">
                                            <th width="20px">Input X (Luas Lahan)</th>
                                            <th width="20px">Input Y (${selectedText})</th>
                                            <th width="20px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" onClick="addrow(event)" class="btn btn-primary mx-2">
                                    Add
                                </button>
                                <button type="submit" class="btn bg-success bg-darken-4 text-white">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                `;
                formInput.innerHTML += htmlElement;
                data_input(selectedValue);

            });



        });
    </script>
    <script>
        function addrow(event) {
            event.preventDefault();
            var tbody = document.querySelector('#table_input tbody');
            var newRow = document.createElement('tr');

            newRow.innerHTML = `
                    <td><input type="number" step="any" class="form-control" name="input_x[]"></td>
                    <td><input type="number" step="any" class="form-control" name="input_y[]"></td>
                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm delete-row" onClick="delete_row(event)">Delete</button></td>
                `;

            tbody.appendChild(newRow);
        };

        function delete_row(event) {
            if (event.target.classList.contains('delete-row')) {
                var rowToDelete = event.target.closest('tr');
                rowToDelete.remove();
            }
        };
    </script>
@endpush
