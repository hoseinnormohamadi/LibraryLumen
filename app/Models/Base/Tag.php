<?php
namespace App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'Tags';
    protected $fillable = [
        'name'
    ];

    public function Books(){
        return $this->belongsToMany(Book::class,'Book_Tag','tag_id','Book_id');
    }
}