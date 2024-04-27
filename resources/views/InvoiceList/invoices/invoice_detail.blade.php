@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    إضافة فاتورة</span>
            </div>
        </div>

    </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <div class="panel panel-primary tabs-style-2">
        <div class="panel-body tabs-menu-body main-content-body-right border">
            <div class="tab-content">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1 card mg-b-20">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs main-nav-line">
                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">Tab 01</a></li>
                            <li><a href="#tab5" class="nav-link" data-toggle="tab">Tab 02</a></li>
                            <li><a href="#tab6" class="nav-link" data-toggle="tab">Tab 03</a></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane active" id="tab4">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">جدول الفواتير</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $invoice->invoice_number }}</td>
                                                <td>{{ $invoice->invoice_Date }}</td>
                                                <td>{{ $invoice->Due_date }}</td>
                                                <td>{{ $invoice->product }}</td>
                                                <td>{{ $invoice->section->section_name }}</td>
                                                <td>{{ $invoice->Amount_collection }}</td>
                                                <td>{{ $invoice->Amount_Commission }}</td>
                                                <td>{{ $invoice->Discount }}</td>
                                                <td>{{ $invoice->Rate_VAT }}</td>
                                                <td>{{ $invoice->Value_VAT }}</td>
                                                @if ($invoice->Value_Status == 1)
                                                    <td>
                                                        <span
                                                            class="badge badge-pill badge-success">{{ $invoice->Status }}</span>
                                                    </td>
                                                @elseif ($invoice->Value_Status == 2)
                                                    <td>
                                                        <span
                                                            class="badge badge-pill badge-danger">{{ $invoice->Status }}</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span
                                                            class="badge badge-pill badge-warning">{{ $invoice->Status }}</span>
                                                    </td>
                                                @endif
                                                <td>{{ $invoice->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab5">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">تفاصيل الفاتورة</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">م</th>
                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                <th class="border-bottom-0">تاريخ الدفع</th>
                                                <th class="border-bottom-0">المنتج</th>
                                                <th class="border-bottom-0">القسم</th>
                                                <th class="border-bottom-0">ملاحاظات</th>
                                                <th class="border-bottom-0">تاريخ الاضافة</th>
                                                <th class="border-bottom-0">الحالة</th>
                                                <th class="border-bottom-0">المستخدم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($invoices_details as $invoices_detail)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $invoices_detail->invoice_number }}</td>
                                                    <td>{{ $invoices_detail->Payment_Date }}</td>
                                                    <td>{{ $invoices_detail->product }}</td>
                                                    <td>{{ $invoice->section->section_name }}</td>
                                                    <td>{{ $invoices_detail->note }}</td>
                                                    <td>{{ $invoices_detail->created_at }}</td>
                                                    @if ($invoices_detail->Value_Status == 1)
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-success">{{ $invoices_detail->Status }}</span>
                                                        </td>
                                                    @elseif ($invoices_detail->Value_Status == 2)
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-danger">{{ $invoices_detail->Status }}</span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-warning">{{ $invoices_detail->Status }}</span>
                                                        </td>
                                                    @endif
                                                    <td>{{ $invoices_detail->user }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab6">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">تفاصيل الفاتورة</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="card-body pt-0">
                                    <form class="form-horizontal" action="{{ route('attachments.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="invoice_number" name="invoice_number"
                                            value="{{ $invoice->invoice_number }}">
                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                            value="{{ $invoice->id }}">
                                        <div class="col-sm-12 col-md-12">
                                            <input type="file" name="pic" class="dropify"
                                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                        </div>
                                        <div class="form-group mb-0 mt-3 justify-content-end">
                                            <div>
                                                <button type="submit" class="btn btn-primary">تأكيد</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">م</th>
                                                <th class="border-bottom-0">اسم الملف</th>
                                                <th class="border-bottom-0">بواسطة</th>
                                                <th class="border-bottom-0">تاريخ الاضافة</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($invoice_attachments as $invoice_attachment)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $invoice_attachment->file_name }}</td>
                                                    <td>{{ $invoice_attachment->Created_by }}</td>
                                                    <td>{{ $invoice_attachment->created_at }}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-success btn-sm"
                                                            href="{{ route('openFile', [$invoice->invoice_number, $invoice_attachment->file_name]) }}"
                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                            عرض</a>
                                                        <a class="btn btn-outline-info btn-sm"
                                                            href="{{ route('download', [$invoice->invoice_number, $invoice_attachment->file_name]) }}"
                                                            role="button"><i class="fas fa-download"></i>&nbsp;
                                                            تحميل</a>
                                                        <form action="{{ route('deletefile', $invoice_attachment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                                role="button">حذف</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
@endsection
