<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements FilterInterface
{
    /**
     * Redirect authenticated users away from guest-only pages
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // If user is already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
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
