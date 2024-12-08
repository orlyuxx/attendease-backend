<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassSlips extends Model
{
    use HasFactory;
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pass_slips';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pass_slip_id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'reason',
        'time_out',
        'time_in',
        'pass_slip_image',
        'status',
    ];
}
