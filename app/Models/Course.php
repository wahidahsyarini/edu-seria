<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model {
    use HasFactory;

    protected $fillable = ['title', 'description', 'educator_id', 'thumbnail', 'is_published'];

    public function educator() {
        return $this->belongsTo(User::class, 'educator_id');
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function learners() {
        return $this->belongsToMany(User::class, 'enrollments');
    }
}