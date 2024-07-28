<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Controllers\Web\StorageController;
class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'is_correct',
        'status',
        'createuser_id',
        'updateuser_id',
        'type',
        'file',
        'question_id',
        'sequence',

    ];
    protected $appends= ['image_path' ];
    public function getImagePathAttribute(){
        $conv="";
        $strgCtrlr = new StorageController(); 
        if(is_null($this->file)|| $this->file==''){
       //   $conv =$strgCtrlr->DefaultPath('image'); 
        } else if($this->type=='image'){
            $url = $strgCtrlr->AnswerPath();
            $conv =  $url.$this->file;
        }        
            return  $conv;
     }
    public function answersclients(): HasMany
    {
        return $this->hasMany(AnswersClient::class);
    }
    public function createuser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'createuser_id')->withDefault();
    }
    public function updateuser(): BelongsTo
    {
        return $this->belongsTo(User::class,'updateuser_id')->withDefault();
    }
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class)->withDefault();
    }

}
