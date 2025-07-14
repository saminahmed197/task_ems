<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Holding extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'company_name', 'stock_symbol', 'quantity', 'buy_price', 'sector', 'purchase_date', 'current_price'];

    
    public function clients(){
        return $this->belongsToMany(User::class, 'client_holding_user')->withTimestamps();
    }

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
    public function users()
    {
        return $this->belongsToMany(User::class, 'client_holding_user', 'holding_id', 'user_id')->withTimestamps()->wherePivot('is_active', 'Y');
    }

}
