<?php

namespace Modules\Shipping\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpeedshipAuthToken extends Model
{
    use HasFactory;
    protected $table = 'speedship_auth_token';
    protected $guarded = ['id'];
}
