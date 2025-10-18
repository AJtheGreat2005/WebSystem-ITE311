<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Check if user is authenticated before allowing access
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            // Store the intended URL to redirect after login
            session()->set('redirect_url', current_url());
            
            // Set flash message
            session()->setFlashdata('error', 'Please login to access this page.');
            
            // Redirect to login page
            return redirect()->to('/login');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
