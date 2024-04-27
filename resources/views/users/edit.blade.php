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
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل مستخدم</span>
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
                    <h4 class="card-title mb-1">تعديل المستخدم </h4>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" action="{{ route('users.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputEmail1">الاسم كامل</label>
                            <input type="text" class="form-control"placeholder="أدخل الاسم" name="name"
                                value="{{ $user->name }}">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div><br>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="أدخل البريد الالكتروني" name="email" value="{{ $user->email }}">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div><br>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputPassword1">كلمة المرور</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="أدخل كلمة المرور" name="password">
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div><br>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputPassword1">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="أدخل تأكيد كلمة المرور" name="confirm-password">
                        </div>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div><br>
                        @enderror
                        <div class="form-group col-lg-6">
                            <p class="mg-b-10">حالة المستخدم</p>
                            <select class="form-control" name="status">
                                <option value="{{ $user->status }}">{{ $user->status }}</option>
                                <option value="مفعل">مفعل</option>
                                <option value="غير مفعل">غير مفعل</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div><br>
                        @enderror
                        <div class="row mg-b-20">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label class="form-label"> صلاحية المستخدم</label>
                                    {!! Form::select('roles_name[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-success">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
