<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = [
            [
                'name' => 'Wahyudi',
                'major' => 'Informatika',
                'age' => 22,
                'courses' => ['Pemrograman Web', 'Database', 'Cloud computing'],
            ],
            [
                'name' => 'Siti',
                'major' => 'Sistem Informatika',
                'age' => 21,
                'courses' => ['Ux/Design', 'Manajemen proyek', 'Iot'],
            ]
        ];
        return view('students.index', compact('students'));
    }
}
