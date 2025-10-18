<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'email', 'password', 'role', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'role' => 'permit_empty|in_list[user,admin]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 3 characters long',
            'max_length' => 'Name cannot exceed 100 characters',
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please provide a valid email address',
            'is_unique' => 'This email is already registered',
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters long',
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
     * Find user by email
     *
     * @param string $email
     * @return array|null
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Verify user credentials
     *
     * @param string $email
     * @param string $password
     * @return array|false
     */
    public function verifyCredentials(string $email, string $password)
    {
        $user = $this->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    /**
     * Create new user with hashed password
     *
     * @param array $data
     * @return int|false
     */
    public function createUser(array $data)
    {
        // Hash password before saving
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        // Set default role if not provided
        if (!isset($data['role'])) {
            $data['role'] = 'user';
        }

        // Set timestamps
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->insert($data);
    }

    /**
     * Update user information
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateUser(int $id, array $data): bool
    {
        // Hash password if it's being updated
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        // Update timestamp
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->update($id, $data);
    }

    /**
     * Get all users with specific role
     *
     * @param string $role
     * @return array
     */
    public function getUsersByRole(string $role): array
    {
        return $this->where('role', $role)->findAll();
    }

    /**
     * Count total users
     *
     * @return int
     */
    public function getTotalUsers(): int
    {
        return $this->countAllResults();
    }
}
