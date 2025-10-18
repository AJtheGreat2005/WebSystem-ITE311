<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnnouncementModel;

class Announcement extends BaseController
{
    protected $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
    }

    /**
     * Display all announcements
     *
     * @return string
     */
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to view announcements.');
            return redirect()->to('/login');
        }

        // Fetch all announcements with user information
        $data = [
            'title' => 'Announcements - Student Portal',
            'announcements' => $this->announcementModel->getAllWithUser(),
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role'),
            ]
        ];

        return view('announcements', $data);
    }

    /**
     * Display form to create new announcement (Admin only)
     *
     * @return string|RedirectResponse
     */
    public function create()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to access this page.');
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Only administrators can create announcements.');
            return redirect()->to('/announcements');
        }

        $data = [
            'title' => 'Create Announcement - Student Portal',
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role'),
            ]
        ];

        return view('announcements_create', $data);
    }

    /**
     * Store new announcement
     *
     * @return RedirectResponse
     */
    public function store()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Unauthorized access.');
            return redirect()->to('/announcements');
        }

        // Validate input
        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Prepare announcement data
        $announcementData = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'posted_by' => session()->get('userID'),
            'date_posted' => date('Y-m-d H:i:s'),
        ];

        // Create announcement
        if ($this->announcementModel->createAnnouncement($announcementData)) {
            session()->setFlashdata('success', 'Announcement created successfully!');
            return redirect()->to('/announcements');
        } else {
            session()->setFlashdata('error', 'Failed to create announcement. Please try again.');
            return redirect()->back()->withInput();
        }
    }
}
