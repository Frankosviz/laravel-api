<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Technology;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type_id',
        'technology_id',
        'description',
        'slug',
        'technologies_used',
        'start_date',
        'end_date',
        'status',
        'url',
        'repository_url',
        'image_path',
    ];

    public static function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        $count = 1;
        while (Project::where('slug', $slug)->first()) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $count++;
        }
        return $slug;
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

}
