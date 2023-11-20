<?php

namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Entities\User;
use Modules\Base\Entities\Comment;
use Modules\Base\Entities\Photo;
use Modules\Base\Entities\Visit;

class Portfolio extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'comments')->where('status', 1)->whereNull('parent_id');
    }

    public function visits() {
        return $this->morphMany(Visit::class, 'visits');
    }

    public function photos() {
        return $this->morphMany(Photo::class, 'pictures');
    }

    protected static function newFactory()
    {
        return \Modules\Portfolio\Database\factories\PortfolioFactory::new();
    }
}
