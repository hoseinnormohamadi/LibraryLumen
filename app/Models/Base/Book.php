<?php
namespace App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'Books_tbl';
    protected $fillable = [
        'BookName',
        'BookPrice',
        'BookRentPrice',
        'user_id',
    ];
    public function tag(){
        return $this->belongsToMany(Tag::class,'Book_Tag','Book_id','tag_id');
    }

}