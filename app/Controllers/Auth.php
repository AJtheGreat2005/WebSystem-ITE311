<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        // Check if form was submitted
        if ($this->request->getMethod() === 'post') {
            // Set validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'password_confirm' => 'required|matches[password]',
            ];

            if (!$this->validate($rules)) {
                return view('auth/register', [
                    'validation' => $this->validator
                ]);
            }

            // Prepare user data
            $userData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role' => 'user',
            ];

            // Create user using model
            if ($this->userModel->createUser($userData)) {
                session()->setFlashdata('success', 'Registration successful! Please login.');
                return redirect()->to('/login');
            } else {
                session()->setFlashdata('error', 'Registration failed. Please try again.');
            }
        }

        return view('auth/register');
    }

    public function login()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        // Check if form was submitted
        if ($this->request->getMethod() === 'post') {
            // Set validation rules
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                return view('auth/login', [
                    'validation' => $this->validator
                ]);
            }

            // Get form data
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Verify credentials using model
            $user = $this->userModel->verifyCredentials($email, $password);

            if ($user) {
                // Create session
                $sessionData = [
                    'userID' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'isLoggedIn' => true,
                ];
                session()->set($sessionData);

                session()->setFlashdata('success', 'Welcome back, ' . $user['name'] . '!');
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Invalid email or password.');
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        // Destroy session
        session()->destroy();
        session()->setFlashdata('success', 'You have been logged out successfully.');
        return redirect()->to('/login');
    }

    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to access the dashboard.');
            return redirect()->to('/login');
        }

        // Get user data from session
        $data = [
            'name' => session()->get('name'),
            'email' => session()->get('email'),
            'role' => session()->get('role'),
        ];

        return view('auth/dashboard', $data);
    }
}
