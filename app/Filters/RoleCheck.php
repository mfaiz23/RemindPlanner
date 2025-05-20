<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // If not logged in, redirect to login
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Check role if arguments are provided
        if (!empty($arguments)) {
            $requiredRole = $arguments[0];
            $userRole = $session->get('role');
            
            if ($userRole !== $requiredRole) {
                // Redirect to appropriate dashboard based on role
                if ($userRole === 'admin') {
                    return redirect()->to('admin/dashboard');
                } else {
                    return redirect()->to('user/dashboard');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here if needed
    }
}