<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['title', 'content', 'posted_by', 'date_posted', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|min_length[5]|max_length[255]',
        'content' => 'required|min_length[10]',
        'posted_by' => 'required|integer',
        'date_posted' => 'required|valid_date',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Announcement title is required',
            'min_length' => 'Title must be at least 5 characters long',
            'max_length' => 'Title cannot exceed 255 characters',
        ],
        'content' => [
            'required' => 'Announcement content is required',
            'min_length' => 'Content must be at least 10 characters long',
        ],
        'posted_by' => [
            'required' => 'Posted by user ID is required',
            'integer' => 'Posted by must be a valid user ID',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Get all announcements with user information
     *
     * @return array
     */
    public function getAllWithUser(): array
    {
        return $this->select('announcements.*, users.name as posted_by_name, users.role')
                    ->join('users', 'users.id = announcements.posted_by')
                    ->orderBy('announcements.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get recent announcements
     *
     * @param int $limit
     * @return array
     */
    public function getRecent(int $limit = 10): array
    {
        return $this->select('announcements.*, users.name as posted_by_name')
                    ->join('users', 'users.id = announcements.posted_by')
                    ->orderBy('announcements.date_posted', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Create new announcement
     *
     * @param array $data
     * @return int|false
     */
    public function createAnnouncement(array $data)
    {
        // Set date_posted if not provided
        if (!isset($data['date_posted'])) {
            $data['date_posted'] = date('Y-m-d H:i:s');
        }

        // Set timestamps
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->insert($data);
    }

    /**
     * Update announcement
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateAnnouncement(int $id, array $data): bool
    {
        // Update timestamp
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->update($id, $data);
    }

    /**
     * Get announcement by ID with user info
     *
     * @param int $id
     * @return array|null
     */
    public function getAnnouncementWithUser(int $id): ?array
    {
        return $this->select('announcements.*, users.name as posted_by_name, users.role')
                    ->join('users', 'users.id = announcements.posted_by')
                    ->where('announcements.id', $id)
                    ->first();
    }
}
