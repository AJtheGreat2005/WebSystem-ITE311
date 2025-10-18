<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Teacher extends BaseController
{
    /**
     * Teacher Dashboard
     *
     * @return string
     */
    public function dashboard()
    {
        // Check if user is logged in and is a teacher
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to access this page.');
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'teacher') {
            session()->setFlashdata('error', 'Access denied. Teachers only.');
            return redirect()->to('/dashboard');
        }

        // Get user data from session
        $data = [
            'title' => 'Teacher Dashboard',
            'name' => session()->get('name'),
            'email' => session()->get('email'),
            'role' => session()->get('role'),
        ];

        return view('teacher_dashboard', $data);
    }
}
