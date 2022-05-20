<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use Sluggable;
    use HasFactory;
    protected $fillable = ['title','description','status','finished_at','slug'];
    protected $dates = ['finished_at'];
    protected $appends = ['details','my_rank'];

    public function my_result(){
        return $this->hasOne('App\Models\Result')->where('user_id', auth()->user()->id);
    }
    public function results(){
        return $this->hasMany('App\Models\Result');
    }
    public function getDetailsAttribute(){
        if($this->results()->count() > 0){
            return [
                'average' => round($this->results()->avg('point')),
                'user_count' => $this->results()->count(),
            ];
        }else{
            return null;
        }
    }

    public function getMyRankAttribute(){
        $rank = 0;
        foreach($this->results()->orderByDesc('point')->get() as $result){
            $rank += 1;
            if($result->user_id == auth()->user()->id){
                return $rank;
            }
        }
    }

    public function top_ten(){
        return $this->results()->orderByDesc('point')->take(10);
    }

    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date) : null;
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
}
