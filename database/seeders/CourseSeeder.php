<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // course seeder

        $courses = [
            // programming
            [
                'author_id' => 1,
                'category_id' => 1,
                'name' => 'Python Programming Course',
                'course_video' => '',
                'image' => 'python.jpg',
                'description' => "Very Nice course",
                'instructor_name' => 'Alex Robern',
                'price' => 50000
            ],
            [
                'author_id' => 1,
                'category_id' => 1,
                'name' => 'JavaScript Programming Course',
                'course_video' => '',
                'image' => 'js.jpg',
                'description' => "Very Nice course",
                'instructor_name' => 'U Aung',
                'price' => 50000
            ],
            [
                'author_id' => 1,
                'category_id' => 1,
                'name' => 'Php Programming Course',
                'course_video' => '',
                'image' => 'php.png',
                'description' => "Very Nice course",
                'instructor_name' => 'Mrs Smith',
                'price' => 50000
            ],
            [
                'author_id' => 1,
                'category_id' => 1,
                'name' => 'Laravel Framework Course',
                'course_video' => '',
                'image' => 'laravel.jpg',
                'description' => "Very Nice course",
                'instructor_name' => 'Peter Jhonson',
                'price' => 50000
            ],

            // networking
            [
                'author_id' => 1,
                'category_id' => 2,
                'name' => 'A+ Hardware Course',
                'course_video' => '',
                'image' => 'a_plus_course.png',
                'description' => "Very Nice course",
                'instructor_name' => 'Peter Jhonson',
                'price' => 50000
            ],
            [
                'author_id' => 1,
                'category_id' => 2,
                'name' => 'Basic Networking Course',
                'course_video' => '',
                'image' => 'basic_networking.jpg',
                'description' => "Very Nice course",
                'instructor_name' => 'Peter Jhonson',
                'price' => 50000
            ],
        ];

        foreach($courses as $course) {
            Course::create($course);
        }
    }
}
