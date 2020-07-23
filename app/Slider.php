<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	public $table = "sliders";
    protected $fillable = ['title','subtitle', 'text', 'image','slider_url','text_position','status'];
    //public $timestamps = false;
}
