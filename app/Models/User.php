<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = ['password', 'remember_token'];

    // Simple role check helpers
    public function isEducator(): bool {
        return $this->role === 'educator';
    }

    public function isLearner(): bool {
        return $this->role === 'learner';
    }

    // Relationships
    public function courses() {
        return $this->hasMany(Course::class, 'educator_id');
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
}