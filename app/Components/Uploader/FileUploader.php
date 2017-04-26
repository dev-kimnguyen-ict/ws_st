<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 27/04/2017
 * Time: 22:59
 */

namespace App\Components\Uploader;

use App\Jobs\UploadProcess;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\File;

class FileUploader
{
    /** @var User $owner */
    protected $owner;

    /**
     * Set owner
     *
     * @param User $owner
     * @return $this
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Handle upload file
     *
     * @param UploadedFile|array $files
     * @return UploadCollection Collection of Upload model
     */
    public function handle($files)
    {
        $files = $this->normalize($files);

        if ($files->isEmpty()) {
            return null; // Empty collection
        }

        return $this->makeUpload($files);
    }

    /**
     * Normalized files
     *
     * @param array|UploadedFile $files
     * @return Collection
     */
    protected function normalize($files)
    {
        return is_array($files) ? collect($files) : collect([$files]);
    }

    /**
     * Make upload files
     *
     * @param Collection $files
     * @return UploadCollection Collect of upload model
     */
    protected function makeUpload(Collection $files)
    {
        $uploads = $files->map(function (UploadedFile $file) {
            $uuid = Uuid::uuid4();
            $extension = strtolower($file->getClientOriginalExtension());
            $tempFilename = "{$uuid}.{$extension}";

            $upload = Upload::create([
                'uuid' => $uuid->toString(),
                'owner_id' => $this->owner->getKey() ?? null,
                'name' => head(explode('.', $file->getClientOriginalName())),
                'extension' => $extension,
                'size' => 0,
                'mime' => $file->getMimeType(),
            ]);

            // Move to app temp folder:
            $file = $file->move(storage_path('app/temp'), $tempFilename);

            // Add to queue job:
            $this->dispatchUploadProcess($file, $upload);

            return $upload;
        });

        return new UploadCollection($uploads->all());
    }

    /**
     * Dispatch job to upload
     *
     * @param File $file
     * @param Upload $model
     * @return void
     */
    protected function dispatchUploadProcess(File $file, Upload $model)
    {
        $process = new UploadProcess($file->getRealPath(), $model);
        $job = $process->onConnection('sync');

        dispatch($job);
    }
}
