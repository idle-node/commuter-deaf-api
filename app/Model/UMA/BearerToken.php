<?php

namespace App\Model\UMA;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 25 2021 16:09:19
 *
 * BearerToken
 * Insert Description Here...
 */
class BearerToken extends Model
{
    public $timestamps = false;

    public $table = 'uma_bearer_token';

    protected $fillable = ['uuid'];
}
