<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    use SoftDeletes;

    // Validate the product
    public static function validate($data) {
        return \Validator::make($data, static::$rules, static::$messages);
    }
    
    // Rules for Product add validation
    public static $rules = array(
        'name' => 'required',       
        'sku' => 'required',
        'price' => 'required'       
    );
    
    // Messages
    public static $messages = array(
        'name.required' => 'The name is required. ',
        'sku.required' => 'The sku is required.',
        'price.required' => 'The price is required. ',
    );

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the use who created the product.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * Get the views for the product.
     */
    public function views()
    {
        return $this->hasMany('App\ProductViews');
    }

     /**
     * Get the bids for the product.
     */
    public function bids()
    {
        return $this->hasMany('App\ProductBids');
    }

}
