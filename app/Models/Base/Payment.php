<?php
namespace App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'Payment_tbl';
    protected $fillable = [
        'user_id',
        'Book_id',
        'Amount',
        'Book_Status',
        'Payment_Status'
    ];
    public function User()
    {
        return $this->hasOne('App\Models\Base\User','user_id','ID');
    }
}