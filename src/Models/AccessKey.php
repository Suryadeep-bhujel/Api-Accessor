<?php

namespace Bhujel\SecretHeader\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
 
use Illuminate\Support\Str;

if (config("access_config.database") == 'mysql' || config("access_config.database") == null) {
    class ModelFinder extends \Illuminate\Database\Eloquent\Model

    {
    }
}

if (config("access_config.database") == 'mongodb') {
    class ModelFinder extends \Jenssegers\Mongodb\Eloquent\Model

    {
    }
}
class AccessKey extends ModelFinder
{

    use HasFactory;
    protected $fillable = [
        "id",
        "title",
        "addedBy",
        "updateBy",
        "key",
        "type",
        "status",
    ];
    public function getUuidAttribute()
    {
       
    }
    protected static function boot()
    {
        // Boot other traits on the Model
        parent::boot();

        static::creating(function ($model) {
            // dd($model->getKey());
            if ($model->getKey() === null) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }
    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
   
}
