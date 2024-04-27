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
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-11 col-md-12 col-sm-12" style="margin: auto">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-1">تعديل فاتورة </h4>
                    <p class="mb-2">تعديل فاتورة </p>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" action="{{ route('updateStatusPay', $invoice->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('GET')
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="exampleInputEmail1">رقم الفاتورة</label>
                                <input type="text" class="form-control"placeholder="invoice_number" name="invoice_number"
                                    value="{{ $invoice->invoice_number }}" readonly>
                            </div>
                            @error('invoice_number')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                            <div class="form-group col-4">
                                <label for="exampleInputDate1">تاريخ الفاتورة</label>
                                <input type="date" class="form-control" id="exampleInputDate1"
                                    aria-describedby="emailHelp" placeholder="YYYY-MM-DD" name="invoice_Date"
                                    value="{{ $invoice->invoice_Date }}" readonly>
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                            <div class="form-group col-4">
                                <label for="Due_date">تاريخ الاستحقاق</label>
                                <input type="date" class="form-control" id="Due_date" aria-describedby="emailHelp"
                                    placeholder="YYYY-MM-DD" name="Due_date" value="{{ $invoice->Due_date }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="validationCustom01" class="mb-1">اختر القسم</label>
                                <select name="section_id" id="" class="form-control" readonly>
                                    <option value="{{ $invoice->section_id }}">{{ $invoice->section->section_name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="validationCustom01" class="mb-1">اختر المنتج</label>
                                <select name="product" id="product" class="form-control" readonly>
                                    <option value="{{ $invoice->product }}" readonly>{{ $invoice->product }}</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="Amount_collection">مبلغ التحصيل</label>
                                <input type="number" class="form-control" id="Amount_collection"
                                    placeholder="Amount_collection" name="Amount_collection"
                                    value="{{ $invoice->Amount_collection }}" readonly>
                            </div>
                            @error('Amount_collection')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="Amount_Commission">مبلغ العمولة</label>
                                <input type="string" class="form-control" id="Amount_Commission"
                                    placeholder="Amount_Commission" name="Amount_Commission"
                                    value="{{ $invoice->Amount_Commission }}" readonly>
                            </div>
                            @error('Amount_Commission')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                            <div class="form-group col-4">
                                <label for="Discount">الخصم</label>
                                <input type="number" class="form-control" id="Discount" placeholder="Discount"
                                    name="Discount" value="{{ $invoice->Discount }}" readonly>
                            </div>
                            @error('Discount')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                            <div class="form-group col-4">
                                <label for="Rate_VAT" class="mb-1">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()"
                                    readonly>
                                    <option value="" readonly>{{ $invoice->Rate_VAT }}</option>
                                </select>
                            </div>
                            @error('Rate_VAT')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="Value_VAT">قيمة ضريبة القيمة المضافة</label>
                                <input type="number" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>
                            @error('Value_VAT')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror

                            <div class="form-group col-6">
                                <label for="Total"> الاجمالي شامل الضريبة</label>
                                <input type="number" class="form-control" id="Total" name="Total" readonly>
                            </div>
                            @error('Total')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="note">ملاحظات</label>
                            <input type="text" class="form-control" id="note" placeholder="" name="note"
                                value="{{ $invoice->note }}" readonly>
                        </div>
                        @error('note')
                            <div class="alert alert-danger">{{ $message }}</div><br>
                        @enderror
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="Status" class="mb-1">حالة الفاتورة</label>
                                    <select name="Status" id="Status" class="form-control">
                                        <option>--حالة الدفع--</option>
                                        <option value="مدفوعة">مدفوعة</option>
                                        <option value="مدفوعة جزئياً">مدفوعة جزئياً</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="Payment_Date">تاريخ الدفع</label>
                                    <input type="date" class="form-control" id="Payment_Date"
                                        aria-describedby="emailHelp" placeholder="YYYY-MM-DD" name="Payment_Date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 mt-3 justify-content-end col-3">
                            <div>
                                <button type="submit" class="btn btn-primary">حفظ التعديل</button>
                            </div>
                        </div>
                </div>
                </form>
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
