<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Client;
use App\Models\AnswersClient;
use App\Models\Question;
use App\Models\ClientPoint;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function checkvoted($client_id, $question_id)
    {
        $ansclient = AnswersClient::wherehas('answer', function ($query) use ($question_id) {
            $query->where('question_id', $question_id);
        })->where('client_id', $client_id)->first();
        if ($ansclient) {          
            //voted befor
            return 1;
        }
        else{
  //not voted
return 0;
        }
    }
    public function addvote($slug)
    {
        //  $formdata = $request->all();        
        $client_id = auth()->guard('client')->user()->id;
        //  $question_id = $formdata['ques'];
        $answer_id = $slug;
        // return $slug;
        $ansmodel = Answer::find($answer_id);
        $ques = Question::find($ansmodel->question_id);
        //   $ansclient=AnswersClient::where('client_id',$client_id)->where('answer_id', $answer_id)->first(); 
        $ques_id = $ques->id;

   
        $voted=$this->checkvoted( $client_id, $ques_id);
        if (!$voted) {
            //record the answer
            $newObj = new AnswersClient();

            $newObj->points = 1;
            $newObj->client_id = $client_id;
            $newObj->answer_id = $answer_id;
            $newObj->answer_content = $ansmodel->content;
            $newObj->answer_type = $ansmodel->type;
            $newObj->save();// tem 
            $client = Client::find($client_id);
            $client->total_balance += 1;
            $client->balance += 1;
            $client->save();
            //wrong answer

            $newObj->save();
            $resArr = [
                'balance' => $client->balance,
                'result' => 1,
            ];
        } else {
            $resArr = [
                'balance' => 0,
                'result' => 0,

            ];
        }
        return response()->json($resArr);

    }

    public function voteresult($slug)
    {
        $question_id = $slug;
        return response()->json($this->resultbyquesid($question_id));
    }

    public function resultbyquesid($question_id)
    {
        $clientanslist = AnswersClient::wherehas('answer', function ($query) use ($question_id) {
            $query->where('question_id', $question_id);
        })->get();
        $anslist = Answer::where('question_id', $question_id)->get();
        $resArr = [];
        foreach ($anslist as $answer) {
            $anscount = $clientanslist->where('answer_id', $answer->id)->count();
            $ansArr = [
                'answer_id' => $answer->id,
                'answer_content' => $answer->content,
                'anscount' => $anscount
            ];

            $resArr[] = $ansArr;
        }
        return $resArr;
    }

    public function resultwithimg($question_id)
    {
        $clientanslist = AnswersClient::wherehas('answer', function ($query) use ($question_id) {
            $query->where('question_id', $question_id);
        })->get();
        $anslist = Answer::where('question_id', $question_id)->get();
        $resArr = [];
        foreach ($anslist as $answer) {
            $anscount = $clientanslist->where('answer_id', $answer->id)->count();

            $ansArr = [
                'answer_id' => $answer->id,
                'answer_content' => $answer->content,
                'anscount' => $anscount,
                'image_path' => $answer->image_path,
                'sequence' => $answer->sequence,
                'percent' => 0,
            ];
             $resArr[] = $ansArr;
        }
        $resArr = $this->calcpercent($resArr);
        $resArr = collect($resArr)->sortBy('anscount')->reverse()->toArray();
        //  $resArr=collect($resArr)->sortBy('count')->toArray();
        return $resArr;
    }
    public function calcpercent($resArr)
    {
        $itemscount = collect($resArr)->where('anscount', '>', 0)->sum('anscount');
        $maiArr = [];
        if ($itemscount > 0) {
            foreach ($resArr as $answer) {
                //calc percent
                $perc =  round(($answer['anscount'] * 100) / $itemscount,1);

                $ansArr = [
                    'answer_id' => $answer['answer_id'],
                    'answer_content' => $answer['answer_content'],
                    'anscount' => $answer['anscount'],
                    'image_path' => $answer['image_path'],
                    'sequence' => $answer['sequence'],
                    'percent' => $perc,
                ];
                $maiArr[] = $ansArr;
            }
        } else {
            $maiArr = $resArr;
        }
        return $maiArr;

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->del_answer($id);
        return redirect()->back();
    }
    public function destroyans($id)
    {
        $this->del_answer($id);
        return response()->json("ok");
    }
    public function del_answer($id)
    {
        $item = Answer::find($id);
        if (!($item === null)) {
            $oldimagename = $item->file;
            $strgCtrlr = new StorageController();
            $path = $strgCtrlr->path['answers'];
            Storage::delete("public/" . $path . '/' . $oldimagename);
            Answer::find($id)->delete();
        }
        return 1;
    }


}
