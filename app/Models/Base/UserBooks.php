<?php
namespace App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class UserBooks extends Model
{
    protected $table = 'UserBooks_tbl';
    protected $fillable = [
        'BookID',
        'UserID',
        'Status',
        'RentStatus'
    ];
    public function Details(){
        return $this->belongsTo(Book::class,'BookID');
    }

}