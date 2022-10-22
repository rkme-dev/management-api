<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'filename',
        'filepath',
        'format',
        'morphable_type',
        'morphable_id',
        'created_by',
        'updated_by',
    ];

    protected $table = 'files';

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getFilepath(): ?string
    {
        return $this->filepath;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function getMorphClass(): mixed
    {
        return $this->type;
    }

    public function type(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'morphable_type', 'morphable_id');
    }
}
