



                <div class="row">
                    @foreach ($results as $answer)
                    @if($type == 'image')

                    <div class="col-12 col-md-4 " data-answer-id="{{ $answer['answer_id'] }}">
                        <div>
                            <img src="{{ asset($answer['image_path']) }}" alt="" style="width: 200px; height: 200px;">
                        </div>
                        <hr>
                        <div>
                            <label>{{ $answer['answer_content'] }}</label>
                            {{-- <input name="answer" class="answer-option" type="radio" value="{{ $answer->id }}"> --}}
                        </div>

                        <div id="results"></div>
                    </div>
                    
                    @else
                        <div class="col-12">
                            <label>{{ $answer['answer_content'] }}</label>
                            {{-- <input name="answer" type="radio" value=""> --}}
                        </div>

                        <div id="results"></div>
                    @endif
                    @endforeach
                </div>

       


