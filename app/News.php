<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class News extends Model
{
	use Sluggable, SluggableScopeHelpers;

	/**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(){

    	return $this->belongsTo('App\User');
    }

    public function categories(){

    	return $this->belongsToMany('App\Category');
    }

    public function comments(){

    	return $this->hasMany('App\Comment');
    }
}
