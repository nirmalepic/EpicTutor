<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   /**
 * The table associated with the model.
 *
 * @var string
 */
    protected $table = 'categories';
    protected $fillable = [
     'name', 'parentid', 'description','feature_image','status','role','slug'
    ];
    public function parentId()
    {
        return $this->belongsTo('App\Category', 'parentid', 'id');
    }

}
