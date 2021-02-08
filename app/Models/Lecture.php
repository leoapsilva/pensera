<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'name',
        'description',
        'link',
        'course_id',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('description', 'like', '%'.$query.'%')
                ->orWhere('course.name', 'like', '%'.$query.'%');
        
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
