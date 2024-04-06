@extends('layout.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2">
                    <h3 class="content-header-title mb-0 d-inline-block">
                        Forecasting
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
                                    <div class="card-body d-flex justify-content-center">
                                        <form action="#">
                                            <div class="form-group">
                                                <label for="contactinput5">Luas Lahan</label>
                                                <input class="form-control border-primary" type="text"
                                                    placeholder="Luas Lahan" id="contactinput5">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn bg-success bg-darken-4 text-white">Prediksi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <section id="configuration">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Hasil Perhitungan</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                                <div class="heading-elements">
                                                    <ul class="list-inline mb-0">
                                                        <li>
                                                            <a data-action="collapse"><i class="ft-minus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-action="expand"><i class="ft-maximize"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <h2>$$b = {N\sum(XY) - \sum X \sum Y \over N \sum X^2 - (\sum X)^2}$$
                                                    </h2>
                                                    <h2>$$a = {\sum Y - b(\sum X) \over n}$$</h2>
                                                    <h2>$$Y = {a + bX}$$</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
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
    <script src="../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
    <script src="../app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
    <script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
    <script>
        MathJax.Hub.Config({
            tex2jax: {
                inlineMath: [
                    ['$', '$'],
                    ['\\(', '\\)']
                ]
            }
        });
    </script>
@endpush
