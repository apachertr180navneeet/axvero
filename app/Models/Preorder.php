<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class Preorder extends Model
{
    use HasFactory,PreventDemoModeChanges;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function preorder_product(){
        return $this->belongsTo(PreorderProduct::class,'product_id');
    }
    
    public function address(){
        return $this->belongsTo(Address::class)->with(['country','state','city']);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'product_owner_id', 'user_id');
    }

    public function preorderCommissionHistory()
    {
        return $this->hasOne(PreorderCommissionHistory::class);
    }
}

