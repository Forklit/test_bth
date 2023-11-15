<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['article', 'name', 'status', 'data'];

    public function getStatusAttribute($value) {
        return $value == 'available' ? 'Доступен' : 'Не доступен';
    }

    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

    public function scopeAvailable($query)
    {
        $query->where('status', 'available');
    }
}
