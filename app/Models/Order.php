<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //fillableで指定している'customer_name', 'customer_mail', 'payment_method', 'total'以外のDB更新は制限
    protected $fillable = ['customer_name', 'customer_mail', 'payment_method', 'total'];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity')->withTimestamps();
    }
}
