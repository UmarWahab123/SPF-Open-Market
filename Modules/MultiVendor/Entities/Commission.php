<?php

namespace Modules\MultiVendor\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\User;


class Commission extends Model
{
    use HasFactory , HasTranslations;
    protected $table = "commissions";
    protected $guarded = ["id"];
    public $translatable = [];
    protected $appends = [];
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

}
