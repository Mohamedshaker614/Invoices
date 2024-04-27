@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الدفتر</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الفواتير</span>
            </div>
        </div>

    </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')


    @if (session()->has('delete_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('Add_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم إضافة الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif



    @if (session()->has('Archive'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم نقل الفاتورة الي الارشيف الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('edit_status'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل حالة الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif


    @if (session()->has('Status_Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حالة الدفع بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('restore_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم استعادة الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif


    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">جدول الفواتير</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="card-header pb-0">
                    @can('اضافة فاتورة')
                        <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                    @endcan
                    @can('تصدير EXCEL')
                        <a class="modal-effect btn btn-sm btn-primary" href="{{ url('invoices_export') }}"
                            style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير Excel</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example5" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">م</th>
                                <th class="border-bottom-0">رقم الفاتورة</th>
                                <th class="border-bottom-0">تاريخ الفاتورة</th>
                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="border-bottom-0">المنتج</th>
                                <th class="border-bottom-0">القسم</th>
                                <th class="border-bottom-0">مبلغ التحصيل</th>
                                <th class="border-bottom-0">مبلغ العمولة</th>
                                <th class="border-bottom-0">الخصم</th>
                                <th class="border-bottom-0">نسبة ضريبة القيمة المضافة</th>
                                <th class="border-bottom-0">قيمة ضريبة القيمة المضافة</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">ملاحاظات</th>
                                <th class="border-bottom-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($invoices as $invoice)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->invoice_Date }}</td>
                                    <td>{{ $invoice->Due_date }}</td>
                                    <td>{{ $invoice->product }}</td>
                                    <td>
                                        @if ($invoice->section)
                                            <a href="{{ route('invoice_detail.edit', $invoice->id) }}">{{ $invoice->section->section_name }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $invoice->Amount_collection }}</td>
                                    <td>{{ $invoice->Amount_Commission }}</td>
                                    <td>{{ $invoice->Discount }}</td>
                                    <td>{{ $invoice->Rate_VAT }}</td>
                                    <td>{{ $invoice->Value_VAT }}</td>
                                    @if ($invoice->Value_Status == 1)
                                        <td>
                                            <span class="badge badge-pill badge-success">{{ $invoice->Status }}</span>
                                        </td>
                                    @elseif ($invoice->Value_Status == 2)
                                        <td>
                                            <span class="badge badge-pill badge-danger">{{ $invoice->Status }}</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-pill badge-warning">{{ $invoice->Status }}</span>
                                        </td>
                                    @endif
                                    <td>{{ $invoice->note }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn- dropdown-toggle" type="button" id="dropdownMenu2"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ...
                                            </button>
                                            @can('تعديل الفاتورة')
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <a class="dropdown-item" type="button"
                                                        href="{{ route('invoices.edit', $invoice->id) }}">تعديل</a>
                                                @endcan
                                                @can('حذف الفاتورة')
                                                    <a class="dropdown-item" href="#"
                                                        data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                        data-target="#delete_invoice"><i
                                                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                        الفاتورة</a>
                                                @endcan
                                                @can('تغير حالة الدفع')
                                                    <a class="dropdown-item" type="button"
                                                        href="{{ route('statusPay', $invoice->id) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i>تغيير حالة الدفع</a>
                                                @endcan
                                                @can('ارشفة الفاتورة')
                                                    <a class="dropdown-item" href="#"
                                                        data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                        data-target="#archive_invoice"><i
                                                            class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp; نقل إلي
                                                        الارشيف</a>
                                                @endcan
                                                @can('طباعةالفاتورة')
                                                    <a class="dropdown-item" type="button"
                                                        href="{{ route('printInvoice', $invoice->id) }}"><i
                                                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة الفاتورة</a>
                                                @endcan
                                                {{-- <form action="{{ route('softDelete', $invoice->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">حذف 2</button>
                                                </form> --}}


                                            </div>
                                        </div>
                                    </td>
                                    {{-- حذف نهائي --}}
                                    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <form action="{{ route('softDelete', $invoice->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            هل انت متاكد من عملية الحذف ؟
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">الغاء</button>
                                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- نقل الي الارشيف --}}
                                    <div class="modal fade" id="archive_invoice" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">أرشفة الفاتورة
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <form action="{{ route('softDelete', $invoice->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            هل انت متاكد من عملية الارشفة ؟
                                                            <input type="hidden" name="page_id" id="page_id"
                                                                value="2">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">الغاء</button>
                                                            <button type="submit" class="btn btn-success">تاكيد</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $invoices->render() !!}
                </div>
            </div>
        </div>
    </div>
    <!--/div-->

    <!--div-->

    </div>
    <!-- حذف الفاتورة -->

    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
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
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
    <script>
        $('#archive_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>


@endsection
