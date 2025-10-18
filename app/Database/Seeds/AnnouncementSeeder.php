<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome to the New Academic Year 2025',
                'content' => 'We are excited to welcome all students to the new academic year! Please make sure to check your schedules and attend the orientation session on Monday. We wish you all a successful and productive year ahead.',
                'posted_by' => 1, // Assuming user ID 1 is an admin
                'date_posted' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'title' => 'Midterm Examination Schedule Released',
                'content' => 'The midterm examination schedule has been posted on the portal. Please review your exam dates and times carefully. Make sure to arrive 15 minutes before your scheduled exam time. Good luck to all students!',
                'posted_by' => 1,
                'date_posted' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'title' => 'Library Hours Extended for Finals Week',
                'content' => 'To support students during the finals period, the library will be open 24/7 starting next week. Additional study rooms are available for group discussions. Please maintain silence in designated quiet zones.',
                'posted_by' => 1,
                'date_posted' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('announcements')->insertBatch($data);
    }
}
