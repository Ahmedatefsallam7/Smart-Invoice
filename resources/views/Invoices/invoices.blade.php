@extends('layouts.master')
@section('title')
    قائمه الفواتير
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الفواتير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمه
                    الفواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('restore'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('delete'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    {{-- @can('اضافة فاتورة') --}}
                        <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                    {{-- @endcan --}}

                    {{-- @can('تصدير اكسيل') --}}
                        <a href="{{ route('export') }}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-file-download"></i>&nbsp; تصدير اكسيل</a>
                    {{-- @endcan --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">


                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتوره</th>
                                    <th class="border-bottom-0"> اسم المستخدم</th>
                                    <th class="border-bottom-0">تاريخ الفاتوره</th>
                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                    <th class="border-bottom-0">المنتج</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">نسبه الضريبه</th>
                                    <th class="border-bottom-0">قيمه الضريبه</th>
                                    <th class="border-bottom-0">الاجمالي </th>
                                    {{-- <th class="border-bottom-0">الحاله </th> --}}
                                    <th class="border-bottom-0"> ملاحظات</th>
                                    <th class="border-bottom-0"> العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php  $count =0;   @endphp
                                @foreach ($headers as $item)
                                    @php $count++;   @endphp
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $item->invoice_number }}</td>
                                        <td>{{ $item->section->created_by }}</td>
                                        <td>{{ $item->invoice_date }}</td>
                                        <td>{{ $item->due_date }}</td>
                                        <td>{{ $item->product }}</td>
                                        <td>
                                            <a
                                                href="{{ route('invoice-detailes.show', $item->id) }}">{{ $item->section->section_name }}</a>
                                        </td>
                                        <td>{{ $item->Discount }}</td>
                                        <td>{{ $item->Rate_Vat }}</td>
                                        <td>{{ $item->Value_Vat }}</td>
                                        <td>{{ $item->Total }}</td>
                                        {{-- <td>
                                            @if ($item->Value_Status == 1)
                                                <span class="tx-success">مدفوعه</span>
                                            @elseif ($item->Value_Status == 2)
                                                <span class="tx-danger">غير مدفوعه</span>
                                            @else
                                                <span class="tx-warning">مدفوعه جزئيا</span>
                                            @endif
                                        </td> --}}
                                        <td>{{ $item->note }}</td>
                                        {{-- @can('العمليات') --}}
                                            <td>
                                                <div class="dropdown">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-secondary btn-sm" data-toggle="dropdown"
                                                        type="button">العمليات
                                                        <i class="fas fa-caret-down"></i>
                                                    </button>

                                                    <div class="dropdown-menu text-center tx-13">

                                                        {{-- @can('تعديل الفاتورة') --}}
                                                            <a style="font-size: 12px" class="dropdown-item"
                                                                href="{{ route('invoices.edit', $item->id) }}">
                                                                <i class="text-success fas fa-pen"></i>&nbsp;&nbsp;

                                                                تعديل الفاتوره</a>
                                                        {{-- @endcan --}}

                                                        {{-- @can('حذف الفاتورة') --}}
                                                            <a class="dropdown-item" href="#"
                                                                data-invoice_id="{{ $item->id }}" data-toggle="modal"
                                                                data-target="#deleteInvoice"><i
                                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                الفاتوره</a>
                                                        {{-- @endcan --}}

                                                        {{-- @can('تغير حالة الدفع') --}}
                                                            <a class="dropdown-item" href="{{ route('statusShow', $item->id) }}"><i
                                                                    class="text-success fa fa-money-bill"></i>&nbsp;&nbsp;تغيير
                                                                حالة الدفع</a>
                                                        {{-- @endcan --}}

                                                        {{-- @can('نقل الي الارشيف') --}}
                                                            <a class="dropdown-item" href="#"
                                                                data-invoice_id="{{ $item->id }}" data-toggle="modal"
                                                                data-target="#archiveInvoice"><i
                                                                    class="text-warning typcn typcn-folder"></i>&nbsp;&nbsp;
                                                                نقل الي الارشيف</a>
                                                            </a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('طباعةالفاتورة') --}}
                                                            <a class="dropdown-item"
                                                                href="{{ route('printInvoice', $item->id) }}"><i
                                                                    class="text-success fa fa-print"></i>&nbsp;&nbsp;
                                                                طباعة الفاتوره</a>
                                                            </a>
                                                        {{-- @endcan --}}
                                                    </div>
                                                </div>
                                            </td>
                                        {{-- @endcan --}}

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>


    <!-- حذف الفاتورة -->
    <div class="modal fade" id="deleteInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('deleteInvoice') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- أرشيف الفاتورة -->
    <div class="modal fade" id="archiveInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">أرشيف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('makeArchive') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الأرشفة ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>

        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>

    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>


    <!-- حذف الفاتورة -->
    <script>
        $('#deleteInvoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>

    <!-- أرشيف الفاتورة -->
    <script>
        $('#archiveInvoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
@endsection
