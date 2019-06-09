<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBids extends Model
{
    use SoftDeletes;

    // Validate the product
    public static function validate($data) {
        return \Validator::make($data, static::$rules, static::$messages);
    }

    // Rules for Product Bid validation
    public static $rules = array(
        'email' => 'required|email',       
        'amount' => 'required|numeric'  
    );
    
    // Messages
    public static $messages = array(
        'email.required' => 'The email is required. ',
        'email.email' => 'The email should be a valid email. ',
        'amount.required' => 'The amount is required.',
        'amount.numeric' => 'The amount should be number only. ',
    );
}
