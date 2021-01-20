<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'user_id', 'b_no', 'h_name','f_no','call_time', 'receive_time', 'status'
    ];
}
