@extends('layouts.master')
@section('title')
الرئيسيه
@endsection
@section('css')
<!--  Owl-carousel css-->
<link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>

            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ " أهلا بك  ".auth()->user()->name }}</h2>
            <p style="text-decoration-line: underline" class="mg-b-0"><a target="blank" href="https://.{{ auth()->user()->email }}">
                    {{ auth()->user()->email  }}</a></p>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">

                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h1 class="">
                                <div class="tx-15 text-white">
                                    عدد الفواتير :
                                    <span>{{ \App\Models\Invoice::count() }}</span>
                                </div>
                                <span class="tx-20 text-white">اجمالي الفواتير</span>
                                <span class="tx-17 font-weight-bold mb-1 text-white">‘‘
                                    {{ number_format(\App\Models\Invoice::sum('Total'), 2) }} ’’
                                </span>
                            </h1>
                            <div class="float-right my-auto mr-auto">

                                @if (\App\Models\Invoice::count() >= 1)
                                <span class="text-white op-7">
                                    النسبه المئويه :
                                    {{ number_format((\App\Models\Invoice::count() / \App\Models\Invoice::count()) * 100, 2) }}%</span>
                                @else
                                <span class="text-white op-7">
                                    النسبه المئويه :
                                    0%</span>
                                @endif

                                <i class="fas fa-arrow-circle-up text-white"></i>
                            </div>
                            <p class="mb-0 tx-5 text-white op-7">
                                <a style="margin-top:10px;display: inline-block;color: white;text-decoration-line:underline" href="{{ route('all_Invoices') }}">اضغط هنا لعرض كل الفواتير</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">

                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h1 class="">
                                <div class="tx-15 text-white">
                                    عدد الفواتير الغير مدفوعه :
                                    <span>{{ \App\Models\Invoice::where('Value_Status', 2)->count() }}</span>
                                </div>
                                <span class="tx-15 text-white">اجمالي الفواتير الغير مدفوعه </span>
                                <span class="tx-17 font-weight-bold mb-1 text-white">
                                    ‘‘
                                    {{ number_format(\App\Models\Invoice::where('Value_Status', 2)->sum('Total'), 2) }}
                                    ’’</span>
                            </h1>
                            <div class="float-right my-auto mr-auto">
                                @if (\App\Models\Invoice::count() >= 1)
                                <span class="text-white op-7">
                                    النسبه المئويه :
                                    {{ number_format((\App\Models\Invoice::where('Value_Status', 2)->count() / \App\Models\Invoice::count()) * 100, 2) }}%
                                </span>
                                @else
                                <span class="text-white op-7">
                                    النسبه المئويه :
                                    0%
                                </span>
                                @endif
                                <i class="fas fa-arrow-circle-down text-white"></i>
                            </div>
                            <p class="mb-0 tx-5 text-white op-7"><a style="margin-top: 10px;display: inline-block; color: white;text-decoration-line:underline" href="{{ route('invoices_unpaid') }}">اضغط هنا لعرض كل الفواتير الغير مدفوعه</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">

                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h1 class="">
                                <div class="tx-15 text-white">
                                    عدد الفواتير المدفوعه :
                                    <span>{{ \App\Models\Invoice::where('Value_Status', 1)->count() }}</span>
                                </div>
                                <span class="tx-15 text-white">اجمالي الفواتير المدفوعه</span>
                                <span class="tx-17 font-weight-bold mb-1 text-white">
                                    ‘‘
                                    {{ number_format(\App\Models\Invoice::where('Value_Status', 1)->sum('Total'), 2) }}
                                    ’’</span>
                            </h1>
                            <div class="float-right my-auto mr-auto">
                                @if (\App\Models\Invoice::count() >= 1)
                                <span class="text-white op-7">
                                    النسبه المئويه :
                                    {{ number_format((\App\Models\Invoice::where('Value_Status', 1)->count() / \App\Models\Invoice::count()) * 100, 2) }}%
                                </span>
                                @else
                                <span class="text-white op-7">
                                    النسبه المئويه :
                                    0%
                                </span>
                                @endif
                                <i class="fas fa-arrow-circle-down text-white"></i>
                            </div>
                            <p class="mb-0 tx-5 text-white op-7"><a style="margin-top: 10px;display: inline-block;color: white;text-decoration-line:underline" href="{{ route('invoices_paid') }}">اضغط هنا لعرض كل الفواتير المدفوعه</a></p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">

                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h1 class="">
                                <div class="tx-15 text-white">
                                    عدد الفواتير المدفوعه جزئيا :
                                    <span>{{ \App\Models\Invoice::where('Value_Status', 3)->count() }}</span>
                                </div>
                                <span class="tx-15 text-white"> اجمالي الفواتير المدفوعه جزئيا </span>
                                <span class="tx-17 font-weight-bold mb-1 text-white">

                                    ‘‘
                                    {{ number_format(\App\Models\Invoice::where('Value_Status', 3)->sum('Total'), 2) }}
                                    ’’
                                </span>
                            </h1>

                            <div class="float-right my-auto mr-auto">
                                @if (\App\Models\Invoice::count() >= 1)
                                <span class="text-white op-7">
                                    النسبه المئويه :
                                    {{ number_format((\App\Models\Invoice::where('Value_Status', 3)->count() / \App\Models\Invoice::count()) * 100, 2) }}%
                                </span>
                                @else
                                <span class="text-white op-7">
                                    النسبه المئويه :
                                    0%
                                </span>
                                @endif
                                <i class="fas fa-arrow-circle-down text-white"></i>
                            </div>

                            <p class="mb-0 tx-5 text-white op-7"><a style="margin-top:10px;display: inline-block;color: white;text-decoration-line:underline" href="{{ route('invoices_partial_paid') }}">اضغط هنا لعرض كل الفواتير المدفوعه
                                    جزئيا</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
</div>
<!-- row closed -->

<!-- row opened -->
<div class="row row-sm">
    <div class="col-md-12 col-lg-12 col-xl-7">
        <div class="card">
            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">Bar Chart</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body" style="width: 75%">
                {!! $chartjs->render() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-5">
        <div class="card card-dashboard-map-one">
            <label class="main-content-label">Sales Revenue by Customers in USA</label>
            <span class="d-block mg-b-20 text-muted tx-12">Sales Performance of all states in the United States</span>
            <div class="">
                {!! $chartjs2->render() !!}
                {{-- <div class="vmap-wrapper ht-180" id="vmap2"></div> --}}
            </div>
        </div>
    </div>
</div>

</div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Moment js -->
<script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<!--Internal  Flot js-->
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
<script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
<script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
<!--Internal Apexchart js-->
<script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
<!-- Internal Map -->
<script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
<!--Internal  index js -->
<script src="{{ URL::asset('assets/js/index.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
