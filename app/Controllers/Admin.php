<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    /**
     * Admin Dashboard
     *
     * @return string
     */
    public function dashboard()
    {
        // Check if user is logged in and is an admin
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to access this page.');
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Access denied. Administrators only.');
            return redirect()->to('/dashboard');
        }

        // Get user data from session
        $data = [
            'title' => 'Admin Dashboard',
            'name' => session()->get('name'),
            'email' => session()->get('email'),
            'role' => session()->get('role'),
        ];

        return view('admin_dashboard', $data);
    }
}
