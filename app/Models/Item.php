<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Item extends Model
{
    public function category(): belongsTo {
        return $this->belongsTo(Category::class);
    }
}
