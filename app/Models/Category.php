<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Category extends Model
{
    use SoftDeletes, HasFactory, LogsActivity;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'sort_order',
        'is_active'
    ];

    protected function casts() : array {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ];
    }

    public function parent() : BelongsTo {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children() : HasMany {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['parent_id', 'name', 'slug', 'sort_order', 'is_active'])
        ->logOnlyDirty()
        ->dontLogEmptyChanges();
    }
}
