 
             <!-- قسم 2 -->
            @if ($questions->first())
             @if (Auth::guard('client')->check())
               <div class="row sec-row  ">
                 <div class="col-12 text-center mb-4">
                  <div class="border-bottom text-center">

                    <h3>{{$sitedataCtrlr->gettrans($home_page,'after-login')}}<h3>
                 </div>
                </div>
               </div>
              @else
               <div class="row sec-row">
                 <div class="col-12 text-center mb-4">
                  <div class="  border-bottom text-center">

                  <h3>{{$sitedataCtrlr->gettrans($home_page,'before-choose')}}<h3>
                 </div>
                </div>
               </div>
            @endif 
           @endif  

        @forelse ($questions as $question)
               
          <div class="col-6 col-sm-4 col-md-3 col-lg-6 mb-4 p-1">
            <a href="{{ url($lang.'/vote',$question->id) }}" class="category-link">
              <div class="category-card">
                <img src="{{ $question->image_path }}" alt="{{ $question->content }}">
                <div class="category-overlay">
                  <h6>{{ $question->content }}</h6>
                </div>
              </div>
            </a>
          </div>
          
          @empty
          <div class="row sec-row">
            <div class="col-12 text-center mb-4">
             <p>{{$sitedataCtrlr->gettrans($home_page,'no-sections')}}</p>
            </div>
          </div>
        @endforelse      
		   
		 
