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
                    <h4 class="card-title mb-1">فاتورة جديدة</h4>
                    <p class="mb-2">إنشاء فاتورة جديدة</p>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" action="{{ route('invoices.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="exampleInputEmail1">رقم الفاتورة</label>
                                <input type="text" class="form-control"placeholder="invoice_number" name="invoice_number"
                                    value="{{ old('invoice_number') }}">
                            </div>
                            @error('invoice_number')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                            <div class="form-group col-4">
                                <label for="exampleInputDate1">تاريخ الفاتورة</label>
                                <input type="date" class="form-control" id="exampleInputDate1"
                                    aria-describedby="emailHelp" placeholder="YYYY-MM-DD" name="invoice_Date"
                                    value="{{ old('invoice_Date', date('Y-m-d')) }}">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                            <div class="form-group col-4">
                                <label for="Due_date">تاريخ الاستحقاق</label>
                                <input type="date" class="form-control" id="Due_date" aria-describedby="emailHelp"
                                    placeholder="YYYY-MM-DD" name="Due_date" value="{{ old('Due_date', date('Y-m-d')) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="validationCustom01" class="mb-1">اختر القسم</label>
                                <select name="section_id" id="" class="form-control">
                                    <option value="{{ old('section_id') }}">--حدد القسم--</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-4">
                                <label for="validationCustom01" class="mb-1">اختر المنتج</label>
                                <select name="product" id="product" class="form-control"
                                    value="{{ old('product') }}"></select>
                            </div>
                            <div class="form-group col-4">
                                <label for="Amount_collection">مبلغ التحصيل</label>
                                <input type="number" class="form-control" id="Amount_collection"
                                    placeholder="Amount_collection" name="Amount_collection"
                                    value="{{ old('Amount_collection') }}">
                            </div>
                            @error('Amount_collection')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="Amount_Commission">مبلغ العمولة</label>
                                <input type="number" class="form-control" id="Amount_Commission"
                                    placeholder="Amount_Commission" name="Amount_Commission"
                                    value="{{ old('Amount_Commission') }}">
                            </div>
                            @error('Amount_Commission')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                            <div class="form-group col-4">
                                <label for="Discount">الخصم</label>
                                <input type="number" class="form-control" id="Discount" placeholder="Discount"
                                    name="Discount" value="0" value="{{ old('Discount') }}">
                            </div>
                            @error('Discount')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                            <div class="form-group col-4">
                                <label for="Rate_VAT" class="mb-1">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <option value="{{ old('Rate_VAT') }}">--حدد النسبة--</option>
                                    <option>5%</option>
                                    <option>10%</option>
                                    <option>15%</option>
                                </select>
                            </div>
                            @error('Rate_VAT')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="Value_VAT">قيمة ضريبة القيمة المضافة</label>
                                <input type="number" class="form-control" id="Value_VAT" name="Value_VAT" readonly
                                    value="{{ old('Value_VAT') }}">
                            </div>
                            @error('Value_VAT')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror

                            <div class="form-group col-6">
                                <label for="Total"> الاجمالي شامل الضريبة</label>
                                <input type="number" class="form-control" id="Total" name="Total"
                                    value="{{ old('Total') }}" readonly>
                            </div>
                            @error('Total')
                                <div class="alert alert-danger">{{ $message }}</div><br>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="note">ملاحظات</label>
                            <input type="text" class="form-control" id="note" placeholder="" name="note"
                                value="{{ old('note') }}">
                        </div>
                        @error('note')
                            <div class="alert alert-danger">{{ $message }}</div><br>
                        @enderror

                        <div class="row">
                            <br>
                            <p class="text-danger" style="display: block">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                            <h5 class="card-title" style="display: block">المرفقات</h5>
                            <div class="col-sm-12 col-md-12">
                                <input type="file" name="pic" class="dropify"
                                    accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70"
                                    value="{{ old('pic') }}" />
                            </div><br>
                            <div class="form-group mb-0 mt-3 justify-content-end col-3">
                                <div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
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



    <script>
        $(document).ready(function() {
            $('select[name="section_id"]').on('change', function() {

                var SectionId = $(this).val();
                if (SectionId) {

                    $.ajax({
                        url: "{{ URL::to('section/products') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value +
                                    '</option>');
                            });
                        }
                    })
                }
            })
        })
    </script>
    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }
    </script>
@endsection
