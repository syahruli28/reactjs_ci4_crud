<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Cors implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // INI CUSTOMNYA OY

        // izin untuk domain yang diinginkan
        header("Access-Control-Allow-Origin: *");
        // header yang diizinkan
        header("Access-Control-Allow-Headers: X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method, Authorization");
        // method yang diizinkan
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'OPTIONS') { // jangan izinkan request method options
            die();
        }

        // JANGAN LUPA ATUR FILE FILTER DI FOLDER CONFIG [ALIASES&GLOBAL]

    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
