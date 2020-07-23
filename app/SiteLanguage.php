<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteLanguage extends Model
{
    protected $table = "site_language";
    protected $fillable = ['word','english','chinese','french','spanish'];
    public $timestamps = false;
}
