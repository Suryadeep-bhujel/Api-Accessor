<?php

namespace Bhujel\SecretHeader\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AccessKey extends Model
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
        // dd($this->id->toString());
        // return  $this->id = Str::uuid()->toString();
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
    // public function newQuery()
    // {

    // }
}
