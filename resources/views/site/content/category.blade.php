@extends('site.layouts.layout')

@section('content')
     <!-- المحتوى الرئيسي -->
     <div class="container-fluid content">
      <div class="row justify-content-center">
        <main role="main" class="col-12 col-lg-10 px-4">

            {{-- @if($catquis->type == 'text') --}}
              <div class="row justify-content-center">
                <img src="{{ asset($catquis->image_path) }}" alt="" style="width: 200px; height: 200px; border-radius: 10px;">
              </div> <br>
            {{-- @endif --}}
          
            <div class="row">
              {{ $catquis->content }}
            </div> <br>

            <div class="row">
              @foreach ($catquis->answers as $answer)
                @if($answer->type == 'image')

                  <div class="col-12 col-md-4">
                    <div> <img src="{{ $answer->image_path }}" alt="" style="width: 200px; height: 200px;"> </div>
                    <hr>
                    <div>
                      <label>{{ $answer->content }}</label>
                      <input name="answer" type="radio" value="">
                    </div>
                  </div>
                 
                @else

                  <div class="col-12">
                    <label>{{ $answer->content }}</label>
                    <input name="answer" type="radio" value="">
                  </div>

                @endif
              @endforeach
            </div>

        </main>
      </div>
    </div>

@endsection
@section('js')
  <script src="{{ url('assets/site/js/sweetalert.min.js') }}"></script>
  
  <script src="{{ url('assets/site/js/quiz.js') }}"></script>
  
  <script>
    var correct_answer= "{{$sitedataCtrlr->gettrans($quiz,'correct-answer')}}";
    var wrong_answer="{{$sitedataCtrlr->gettrans($quiz,'wrong-answer')}}";
    var nextlevel_msg="{{$sitedataCtrlr->gettrans($quiz,'nextlevel-msg')}}";
    var no_questions="{{$sitedataCtrlr->gettrans($quiz,'no-questions')}}";

    var cat={{ $catquis['id'] }};

    $(document).ready(function() {
      
      
    });
  </script>
@endsection
