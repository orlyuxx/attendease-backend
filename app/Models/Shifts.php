<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shifts';

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'shift_id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shift_name',
        'shift_start',
        'shift_end'
    ];

}
