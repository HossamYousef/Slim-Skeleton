<?php

namespace App\Model;

use App\Scopes\MaxPerPageScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Abstract Model class
 */
abstract class AbstractModel extends Model
{
    /**
     * Global scope
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new MaxPerPageScope);
    }

    /**
     * Default scope - ALL
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeCurrentUser($query)
    {
        return $query;
    }

    /**
     * Model validation rules
     *
     * @var array
     */
    public static $rules = [];
}
