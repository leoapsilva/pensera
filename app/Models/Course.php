<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    protected $fillable = [
        'professor_id',
        'name',
        'description',
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('description', 'like', '%'.$query.'%');
    }                

    public function professor()
    {
        return $this->hasOne(Professor::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

}
