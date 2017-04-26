<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 27/04/2017
 * Time: 22:32
 */

namespace App\Http\Controllers\Api\Upload;

use App\Components\Uploader\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Upload\StoreFileRequest;
use App\Models\Upload;

class UploadController extends Controller
{
    /**
     * Show form upload file
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.upload.create');
    }

    /**
     * Handle request upload file
     *
     * @param StoreFileRequest $request
     * @param FileUploader $uploader
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFileRequest $request, FileUploader $uploader)
    {
        $uploads = $uploader->setOwner(auth()->user())->handle($request->allFiles());

        if (!$uploads) {
            abort(400);
        }

        $data = $uploads->map(function (Upload $upload) {
            return [
                'uuid' => $upload->uuid,
                'owner_id' => $upload->owner_id,
                'name' => $upload->name,
                'extension' => $upload->extension,

            ];
        });

        return $this->json($data);
    }
}
