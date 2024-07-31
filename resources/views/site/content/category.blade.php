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


            @if ($voted == 1)

              <div class="row">
                @if ($type == 'image')
                    @foreach ($results as $answer)

                        <div class="col-12 col-md-4" data-answer-id="{{ $answer['answer_id'] }}">
                            <div>
                                <img src="{{ asset($answer['image_path']) }}" alt=""
                                    style="width: 200px; height: 200px;">
                            </div>
                            <hr>
                            <div>
                                <label class="col-12">{{ $answer['answer_content'] }}</label>
                                
                                <div class="row">
                                    <div class="col-10" style="padding-left: 4px;">
                                        <div class="w3-border">
                                            <div class="w3-grey" id="percent"
                                                style="width:{{ $answer['percent'] }}%">
                                                {{ $answer['percent'] }}%
                                            </div>
                                              
                                        </div>
                                    </div>
                                    <div class="anscount">
                                        {{ $answer['anscount'] }}
                                    </div>
                                </div>
                                {{-- <input name="answer" class="answer-option" type="radio" value="{{ $answer->id }}"> --}}
                            </div>
                        </div>
                    @endforeach

                @else
                    @foreach ($results as $answer)

                        <div class="col-12" data-answer-id="{{ $answer['answer_id'] }}">
                            <label>{{ $answer['answer_content'] }}</label>

                            <div class="row">
                                <div class="col-10" style="padding-left: 4px;">
                                    <div class="w3-border ">
                                        <div class="w3-grey" id="percent"
                                            style="width:{{ $answer['percent'] }}%">
                                            {{ $answer['percent'] }}%
                                        </div>
                                          
                                    </div>
                                </div>
                                <div class="anscount">
                                    {{ $answer['anscount'] }}
                                </div>
                            </div>

                            {{-- <label>العدد:{{ $answer['anscount'] }}</label> --}}
                            {{-- <label>النسبة:{{ $answer['percent'] }}</label> --}}
                            
                            {{-- <input name="answer" type="radio" value=""> --}}
                        </div>
                    @endforeach
                @endif
              </div>

            @else

            <div class="row answer-main">
              @if($catquis->type == 'image')
              @foreach ($catquis->answers as $answer)

                <div class="col-12 col-md-4" data-answer-id="{{ $answer->id }}">
                  <div>
                      <img src="{{ asset($answer->image_path) }}" alt="" style="width: 200px; height: 200px;">
                  </div>
                  <hr>
                  <div>
                      <label>{{ $answer->content }}</label>
                      <input name="answer" class="answer-option" type="radio" value="{{ $answer->id }}">
                  </div>
                </div>
              
              @endforeach

                @else
                @foreach ($catquis->answers as $answer)

                  <div class="col-12" data-answer-id="{{ $answer->id }}">
                    <label>{{ $answer->content }}</label>
                    <input name="answer" class="answer-option" type="radio" value="{{ $answer->id }}">
                  </div>
              @endforeach

              @endif
             
            </div>
            
            @endif



            {{-- <div class="row answer-main">
              @if($catquis->type == 'image')
              @foreach ($catquis->answers as $answer)

                <div class="col-12 col-md-4" data-answer-id="{{ $answer->id }}">
                  <div>
                      <img src="{{ asset($answer->image_path) }}" alt="" style="width: 200px; height: 200px;">
                  </div>
                  <hr>
                  <div>
                      <label>{{ $answer->content }}</label>
                      <input name="answer" class="answer-option" type="radio" value="{{ $answer->id }}">
                  </div>
                </div>
              
              @endforeach

                @else
                @foreach ($catquis->answers as $answer)

                  <div class="col-12" data-answer-id="{{ $answer->id }}">
                    <label>{{ $answer->content }}</label>
                    <input name="answer" class="answer-option" type="radio" value="{{ $answer->id }}">
                  </div>
              @endforeach

              @endif
             
            </div> --}}
            <div id="results"></div>
        </main>
      </div>
    </div>

@endsection
@section('css')
 
<link rel="stylesheet" href="{{ url('assets/site/css/w3.css') }}" />
@endsection

@section('js')
<script>
  var quesid ='{{ $catquis->id }}';
    $(document).ready(function() {
        $('.answer-option').on('click', function() {
            var answerId = $(this).val();    
            // إرسال ID الجواب إلى الخادم باستخدام AJAX
            $.ajax({
                url: '/addvote/'+answerId,
                method: 'POST',
                data: {
                   // answer_id: answerId,
                    _token: '{{ csrf_token() }}' 
                },
                success: function(response) {
                  if(response.result==1 || response.result==0 ){
                    // إخفاء الخيارات
                    $('.answer-main').hide();
                    
                    loadresults();
                  }else{
                    alert('error1');
                  }
                 
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('error');
                }
            });
        });

        function loadresults() {
          // إرسال ID الجواب إلى الخادم باستخدام AJAX
$.ajax({
    url: '/voteres/'+quesid,
    method: 'GET', 
    success: function(response) {       
        // عرض نسبة الإجابات
        $('#results').html(response); 
   
     
    },
    error: function(xhr) {
        console.log(xhr.responseText);
        alert('error');
    }
});
}
    });
  </script>  
  <script src="{{ url('assets/site/js/sweetalert.min.js') }}"></script>  
  {{-- <script src="{{ url('assets/site/js/quiz.js') }}"></script> --}}  
   

@endsection
