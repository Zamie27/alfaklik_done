<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

class Page404Filter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil current path
        $path = trim($request->getUri()->getPath(), '/');

        // Skip pengecekan untuk path kosong (homepage)
        if (empty($path)) {
            return;
        }

        // Ambil router service
        $routes = \Config\Services::routes();
        $router = \Config\Services::router($routes, $request);

        try {
            // Coba cek route
            $router->handle($path);
        } catch (\Throwable $e) {
            // Jika route tidak ditemukan, tampilkan 404
            throw new PageNotFoundException();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here
    }
}
