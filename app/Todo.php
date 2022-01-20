<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Todo extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'label'
    ];

    /**
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(TodoTask::class);
    }
}
