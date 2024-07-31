                <div class="row" style="direction: rtl; text-align: right;">
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
                                                <div class="w3-grey percent"  
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
                                            <div class="w3-grey percent" 
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
