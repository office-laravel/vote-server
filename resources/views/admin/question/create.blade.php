@extends('admin.layouts.layout')
@section('breadcrumb')
    الاسئلة
@endsection
@section('content')
    <div class="container">

    </div>


    <div class="row backgroundW p-4 m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/question') }}">التصويت</a></li>

                <li class="breadcrumb-item active" aria-current="page">جديد</li>
            </ol>
        </nav>

        <div class="card-body  row">
            <div class="col-lg-12">
                <form class="form-horizontal" name="create_form" method="POST" action="{{ url('admin/question') }}"
                    enctype="multipart/form-data" id="create_form">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="name" class="col-sm-2 col-form-label">اللغة</label>
                            <select name="lang_id" id="lang_id" class="form-controll">
                                <!--placeholder-->
                                <option title=""value="0" class="text-muted">اختر اللغة</option>
                                @foreach ($lang_list as $lang)
                                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                @endforeach



                            </select>
                            <span id="lang_id-error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="name" class="col-sm-2 col-form-label">التصنيف</label>
                            <select name="category_id" id="category_id" class="form-controll">
                                <!--placeholder-->
                                <option title=""value="0" class="text-muted">اختر التصنيف</option>
                                @foreach ($cat_list as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            <span id="category_id-error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="type" class="col-sm-2 col-form-label">نوع التصويت</label>
                            <select name="type" id="type" class="form-controll">
                                <!--placeholder-->
                                <option title=""value="0" class="text-muted">اختر النوع</option>

                                <option value="text" selected>نص</option>
                                <option value="image">صورة</option>
                            </select>
                            <span id="type_error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label for="customFile">Custom File</label> -->
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">الصورة</label>
                            <div class="col-sm-10">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">نص التصويت</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="content" id="content"
                                placeholder="* نص التصويت" value="">

                            <span id="content-error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                    <div id="text-container">
                        <div class="form-group row " id="option-container">
                            <div class="col-sm-12 col-12">
                                <label class="col-12 col-form-label" style="text-align: right">الخيارات</label>
                            </div>

                            @php
                                $i = 1;
                            @endphp
                            @for ($i = 1; $i < 3; $i++)
                                <div class="col-sm-6 col-12 ans-col">
                                    <div class="form-group row">
                                        <span class="col-sm-1 col-2 num-span">{{ $i }}-</span>
                                        <div class="col-sm-9 col-8">
                                            <input type="text" class="form-controll inputtxt"
                                                name="op_content[{{ $i }}]" id="op_content-{{ $i }}"
                                                placeholder="الخيار {{ $i }}" value="">
                                        </div>
                                        <button type="button" class="btn-del-op col-sm-1 col-1" style="display: block;"><i
                                                class="fas fa-times" style="font-size:16px;color:red;"></i>
                                        </button>
                                    </div>
                                </div>
                            @endfor

                        </div>

                        <div class="form-group row text-center">

                            <div class="col-sm-12">
                                <button type="button" id="btn_add_option" name="btn_add_option"
                                    class="btn btn-primary ">إضافة خيار</button>
                            </div>
                        </div>
                    </div>
                    {{-- image options  style="display: none;" --}}
                    <div id="image-container" style="display: none;">
                        <div class="form-group row " id="image-div-container">
                            <div class="col-sm-12 col-12">
                                <label class="col-12 col-form-label" style="text-align: right">الخيارات صور</label>
                            </div>

                            @php
                                $i = 1;
                            @endphp
                            @for ($i = 1; $i < 3; $i++)
                                <div class="col-sm-6 col-md-3 ans-col">
                                    <div class="form-group row">
                                        <div class="col-sm-12  sm-3 div-op-image ">
                                            <img alt="" id="imgshow-{{ $i }}"
                                                class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0 imageicon"
                                                src="{{ $default_op }}">
                                        </div>
                                        <input type="file" accept="image/*" class="custom-file-input input-file-op"
                                            name="img_op[{{ $i }}]" id="image-op-{{ $i }}"
                                            style="display: none;">
                                        <span class="col-sm-1 col-2 img-num-span">{{ $i }}-</span>
                                        <div class="col-sm-9 col-8">
                                            <input type="text" class="form-controll inputimg"
                                                name="img_op_content[{{ $i }}]"
                                                id="img_op_content-{{ $i }}"
                                                placeholder="الخيار {{ $i }}" value="">
                                        </div>
                                        <button type="button" class="btn-del-op col-sm-1 col-1"
                                            style="display: block;"><i class="fas fa-times"
                                                style="font-size:16px;color:red;"></i>
                                        </button>
                                    </div>
                                </div>
                            @endfor

                        </div>

                        <div class="form-group row text-center">

                            <div class="col-sm-12">
                                <button type="button" id="btn_img_add_option" name="btn_img_add_option"
                                    class="btn btn-primary ">إضافة خيار</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">الحالة</label>
                        <div class="col-sm-10 custom-control custom-switch ">
                            <input type="checkbox" class="custom-control-input" id="status" name="status"
                                value="1" checked="checked">
                            <label class="custom-control-label" for="status" id="status_lbl">الحالة</label>
                            <span id="status-error" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">

                            <button type="submit" type="submit" name="btn_save"
                                class="btn btn-primary btn-submit">إضافة</button>

                            <a class="btn btn-danger float-right " href="{{ route('question.index') }}">إلغاء</a>
                            <button id="btn_reset" class="btn btn-default float-right  "
                                style="margin-right: 20px;margin-left: 20px">إعادة ضبط</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>

        </main>
        <div class="col-sm-6 col-12 ans-col " id="main-op" style="display: none">
            <div class="form-group row">
                <span class="col-sm-1 col-2 num-span"></span>
                <div class="col-sm-9 col-8">
                    <input type="text" class="form-controll inputtxt" name="" id="" placeholder=""
                        value="">
                </div>
                <button type="button" onclick="delsort(this);" class="btn-del-op col-sm-1 col-1"
                    style="display: block;"><i class="fas fa-times" style="font-size:16px;color:red;"></i>
                </button>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 ans-col" id="img-main-op" style="display: none">
            <div class="form-group row">
                <div class="col-sm-12  sm-3 div-op-image ">
                    <img alt="" id=""
                        class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0 imageicon"
                        src="{{ $default_op }}">
                </div>
                <input type="file" accept="image/*" class="custom-file-input input-file-op" name=""
                    id="" style="display: none;">
                <span class="col-sm-1 col-2 img-num-span">{{ $i }}-</span>
                <div class="col-sm-9 col-8">
                    <input type="text" class="form-controll inputimg" name="" id="" placeholder=""
                        value="">
                </div>
                <button type="button" onclick="delimgsort(this);" class="btn-del-op col-sm-1 col-1"
                    style="display: block;"><i class="fas fa-times" style="font-size:16px;color:red;"></i>
                </button>
            </div>
        </div>
    @endsection
    @section('css')
        <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/content.css') }}">
    @endsection
    @section('js')
        <script src="{{ URL::asset('assets/admin/js/ques.js') }}"></script>
    @endsection
