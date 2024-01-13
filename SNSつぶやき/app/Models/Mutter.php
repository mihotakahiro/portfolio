<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Mutter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'posts';     
    protected $guarded = ['id'];

    public static $rules = [
        'body' => 'required',
    ];

    public function user(){
        return $this->belongsTo(\App\Models\User::class,'user_id');
    }

}
