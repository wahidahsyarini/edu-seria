<?php
namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy {
    public function create(User $user): bool {
        return $user->isEducator();
    }
    public function update(User $user, Course $course): bool {
        return $user->isEducator()
            && $course->educator_id === $user->id;
    }
    public function delete(User $user, Course $course): bool {
        return $user->isEducator()
            && $course->educator_id === $user->id;
    }
}