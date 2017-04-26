<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Set page information
     *
     * @param string $title
     * @param string $subTitle
     */
    public function setPageInfo($title = '', $subTitle = '')
    {
        $globals = app('globals');
        $globals->set('title', $title);
        $globals->set('sub_title', $subTitle);
    }

    /**
     * Return json response
     *
     * @param array $data
     * @param bool $success
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($data = [], $success = true, $status = 200, array $headers = [], $options = 0)
    {
        $data = [
            'success' => $success,
            'payload' => $data,
        ];

        return response()->json($data, $status, $headers, $options);
    }
}
