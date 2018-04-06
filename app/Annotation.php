<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    protected $fillable = [
    	'user_id',
    	'article_id',
        'content',
        'user_id',
    ];
	
	protected $hidden = [
    ];
	
	
	public function user(){
		return $this->belongsTo(User::class);
	}
	
	public function article(){
		return $this->belongsTo(Article::class);
	}
}
