<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];
    //protected $with = ['seasons']; // Já trás todas as temporadas da série


    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy('nome');
        });
    }
}
