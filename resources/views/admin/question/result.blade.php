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

                <li class="breadcrumb-item active" aria-current="page">تعديل</li>
            </ol>
        </nav>

        <div class="card-body  row">
            <div class="col-lg-12">

                <form class="form-horizontal" name="create_form" method="POST" action="{{route('question.update', $question->id)}}"
                    enctype="multipart/form-data" id="create_form">
                    @csrf
                    
        <div class="  row">
            <div class="col-lg-8">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="name" class="col-sm-2 col-form-label">اللغة</label>
                            <select name="lang_id" id="lang_id" class="form-controll" disabled >
                                <!--placeholder-->
                                <option title=""value="0" class="text-muted">اختر اللغة</option>
                                @foreach ($lang_list as $lang)
                                    <option value="{{ $lang->id }}"
                                        @if ($question->lang_id == $lang->id) @selected(true) @endif>
                                        {{ $lang->name }}</option>
                                @endforeach
                            </select>
                            <span id="lang_id-error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="name" class="col-sm-2 col-form-label">التصنيف</label>
                            <select name="category_id" id="category_id" class="form-controll" disabled>
                                <!--placeholder-->
                                <option title=""value="0" class="text-muted">اختر التصنيف</option>
                                @foreach ($cat_list as $cat)
                                    <option value="{{ $cat->id }}"
                                        @if ($question->category_id == $cat->id) @selected(true) @endif>
                                        {{ $cat->title }}</option>
                                @endforeach
                            </select>
                            <span id="category_id-error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="type-sel" class="col-sm-2 col-form-label" disabled>نوع التصويت</label>
                            <select name="type-sel" id="type" class="form-controll" @disabled(true)>
                                <!--placeholder-->
                                <option title=""value="0" class="text-muted">اختر النوع</option>

                                <option value="text"
                                    @if ($question->type == 'text') @selected(true) @endif>نص</option>
                                <option value="image"
                                    @if ($question->type == 'image') @selected(true) @endif>صورة</option>
                            </select>
                            <input type="hidden" name="type" value="{{ $question->type }}">
                            <span id="type_error" class="error invalid-feedback"></span>

                        </div>
                    </div>
           

                </div>
                <div class="col-lg-4  sm-3 ">
                    <img alt="" id="imgshow"
                        class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0"
                        src="{{ $question->image_path }}">
                </div>
            </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">نص التصويت</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="content" id="content"
                                placeholder="* نص التصويت" value="{{ $question->content }}" disabled>

                            <span id="content-error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                   

                    @if ($question->type == 'text')

                    @php
                    $i = 1;
                 @endphp
                    <div id="text-container">

                        <div class="form-group row " id="option-container">
                            <div class="col-sm-12 col-12">
                                <label class="col-12 col-form-label" style="text-align: right">الخيارات</label>
                            </div>
                       
                                @foreach ($result_arr as $answer)
                                    <div class="col-sm-6 col-12 ans-col">
                                        <div class="form-group row">
                                            <span class="col-sm-1 col-2 num-span">{{$i }}-</span>
                                            <div class="col-sm-9 col-10">
                                                <input type="text" class="form-controll inputtxt"
                                                    name="op_content[{{$i}}]"
                                                    id="op_content-{{$i}}"
                                                    placeholder="الخيار {{ $i }}" value="{{$answer['answer_content'] }}" disabled>
                                            </div>
                                            <span class="col-sm-2 col-2"></span>
                                            <span class="col-sm-7 col-7" style="padding-right: 60px;">عدد الاصوات:</span>
                                            <span class="col-sm-3 col-3"><strong>{{$answer['anscount'] }}</strong></span>
                                            <label style="padding-right: 60px;">النسبة: <strong>{{ $answer['percent'] }} %</strong></label>
                                        </div>
                                    </div>
                                    @php
                                    $i ++;
                                @endphp
                                @endforeach
                        </div>
 
                    </div>
                    @else 
    {{-- image options  style="display: none;" --}}

    <div id="image-container"  >
        <div class="form-group row " id="image-div-container">
            <div class="col-sm-12 col-12">
                <label class="col-12 col-form-label" style="text-align: right">الخيارات </label>
            </div>

            @php
                $i = 1;
            @endphp
                @foreach ($result_arr as $answer)
                <div class="col-sm-6 col-md-3 ans-col">
                    <div class="form-group row">
                        <div class="col-sm-12  sm-3 div-op-image ">
                            <img alt="" id="imgshow-{{ $i}}"
                                class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0 imageicon"
                                src="{{$answer['image_path']  }}">
                        </div>
                        
                        <span class="col-sm-1 col-2  ">{{$i }}-</span>
                        <div class="col-sm-10 col-10">
                            <input type="text" class="form-controll inputimg"
                                name="img_op_content[{{$i}}]"
                                id="img_op_content-{{$i }}"
                                placeholder="الخيار {{$i}}" value="{{$answer['answer_content'] }}" disabled>
                               
                        </div>
                         
                        <span class="col-sm-7 col-8" style="padding-right: 40px;">عدد الاصوات:</span>
                        <span class="col-sm-3 col-3"><strong>{{$answer['anscount'] }}</strong></span>
                        
                        <label style="padding-right: 40px;">النسبة: <strong>{{ $answer['percent'] }} %</strong></label>
                    </div>
                </div>
                @php
                                    $i++ ;
                                @endphp
                                @endforeach

        </div>

        <div class="form-group row text-center">

            <div class="col-sm-12">
               
            </div>
        </div>
    </div>
                    @endif

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">الحالة</label>
                        <div class="col-sm-10 custom-control custom-switch ">
                            <input type="checkbox" class="custom-control-input" id="status" name="status"
                            value="{{ $question->status }}" @if ( $question->status=='1') @checked(true) @endif disabled >
                            <label class="custom-control-label" for="status" id="status_lbl">الحالة</label>
                            <span id="status-error" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">
                            <a class="btn btn-danger float-right " href="{{ route('question.index') }}">عودة</a>
                           

                        </div>
                    </div>
                </form>
            </div>
         
        </div>

        </main>
      

       
      
    @endsection
    @section('css')
        <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/content.css') }}">
    @endsection
    @section('js')
    
       
    @endsection
