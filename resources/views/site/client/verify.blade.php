@extends('site.layouts.layout')

@section('content')
   	    <!-- محتوى الصفحة -->
           <div class="container-fluid content">
            <div class="row justify-content-center">
              <main role="main" class="col-12 col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h2">التحقق من الكود</h1>
                </div>
                
                    <!-- محتوى الصفحة -->
                <div class="row main-content justify-content-center ">
                  <div class="col-md-6">
                    <div class="card login-card">
                      <div class="card-body  bg-style">
                        <h3 class="card-title text-center">التحقق من الكود</h3>
                        
                        <form action ="{{ route('verify.store') }}" method="POST" name="login-form" id="login-form" enctype="multipart/form-data">
                          @csrf
                            <div class="form-group">
                              <label for="code">رمز التحقق</label>
                              <input type="text" class="form-control" id="code"  name="code"  placeholder="أدخل رمز التحقق">
                              <div  id="code-error" class="invalid-feedback"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-submit">تأكيد</button>
                        </form>
                        
                      </div>
                    </div>
                  </div>
                </div>
                 
              </main>
            </div>
          </div>
@endsection

@section('js')

@endsection
