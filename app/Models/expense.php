<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $fillable =['id','name','price','date','status','category_id'];
    public function categories(){
        return $this->belongsTo(category::class);
    }
}
