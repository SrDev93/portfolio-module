<?php

namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function parent()
    {
        return $this->hasOne(PortfolioCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PortfolioCategory::class, 'parent_id')->with('children');
    }

    public function portfolios() {
        return $this->hasMany(Portfolio::class, 'category_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Portfolio\Database\factories\PortfolioCategoryFactory::new();
    }
}
