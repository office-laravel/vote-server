<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Controllers\Web\StorageController;
class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'points',
        'category_id',
        'lang_id',
        'status',
        'createuser_id',
        'updateuser_id',
        'type',
        'file',
    ];

    protected $appends= ['image_path' ];

    public function getImagePathAttribute(){
        $conv="";
        $strgCtrlr = new StorageController(); 
        
        if(is_null($this->file)|| $this->file==''){
          $conv =$strgCtrlr->DefaultPath('default-ques'); 
        } else {
            $url = $strgCtrlr->QuestionPath();
            $conv =  $url.$this->file;
        }        
            return  $conv;
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class,'lang_id')->withDefault();
    }
    
    public function createuser(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function updateuser(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }


}


