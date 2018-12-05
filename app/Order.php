<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_email', 'partner_id', 'status'];

    // Возвращает партнёра
    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    // Возвращает продукты
    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products')->withPivot('quantity', 'price');;
    }
}
