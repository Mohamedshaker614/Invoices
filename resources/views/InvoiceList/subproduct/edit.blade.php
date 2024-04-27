@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل</span>
            </div>
        </div>

    </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12" style="margin: auto">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-1">تعديل المنتج</h4>
                    <p class="mb-2"></p>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                        <div class="card  box-shadow-0">
                            <div class="card-header">
                                <h4 class="card-title mb-1">تعديل المنتج</h4>
                                <p class="mb-2"></p>
                            </div>
                            <div class="card-body pt-0">
                                <form class="form-horizontal" action="{{ route('subproducts.update', $subproduct->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="inputName">اسم المنتج</label>
                                        <input type="text" class="form-control" id="Product_name"
                                            placeholder="Product_name" name="Product_name"
                                            value="{{ $subproduct->Product_name }}">
                                    </div>
                                    @error('Product_name')
                                        <div class="alert alert-danger">{{ $message }}</div><br>
                                    @enderror
                                    <div class="form-group">
                                        <label for="validationCustom01" class="mb-1">اسم القسم</label>
                                        <select name="section_id" id="" class="form-control">
                                            <option value="{{ $subproduct->section_id }}">
                                                {{ $subproduct->section->section_name }}</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">الوصف</label>
                                        <input type="text" class="form-control" id="description"
                                            placeholder="description" name="description"
                                            value="{{ $subproduct->description }}">
                                    </div>
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
