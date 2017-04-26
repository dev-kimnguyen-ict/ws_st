<?php

namespace App\Jobs;

use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;

class UploadProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var File $file */
    protected $file;

    /**
     * Upload model
     *
     * @var Upload $model
     */
    protected $model;

    /**
     * UploadProcess constructor.
     *
     * @param string $realPath
     * @param Upload $model
     */
    public function __construct($realPath, Upload $model)
    {
        $this->file = $realPath;
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @param Filesystem $system
     */
    public function handle(Filesystem $system)
    {
        $this->file = $this->normalize($this->file);

        $id = $this->model->uuid;
        $mime = $this->file->getMimeType();
        $type = $mime ? Str::plural(Str::snake(head(explode('/', $mime)))) : 'unknown';

        $path = $this->model->owner->uploadPath() . '/' . $type;

        $system->makeDirectory($absolute = config('upload.storage_dir') . '/' . $path, 0755, true, true);

        if ($system->move($this->file->getRealPath(), $absolute . '/' . $id . '.' . $this->file->getExtension())) {
            return $this->success($absolute, $id, $type, $mime, $path);
        } else {
            return $this->handleError($id, $type, $mime);
        }
    }

    /**
     * Normalized File
     *
     * @param File|string $file
     * @return File
     */
    protected function normalize($file)
    {
        return is_string($file) ? new File($file) : $file;
    }

    /**
     * @param string $absolute
     * @param int $id
     * @param string $type
     * @param string $mime
     * @param string $path
     */
    protected function success($absolute, $id, $type, $mime, $path)
    {
        $this->file = new File($absolute . '/' . $id . '.' . $this->file->getExtension());

        $this->model->fill([
            'name' => $this->file->getFilename(),
            'size' => $this->file->getSize(),
            'extension' => $this->file->getExtension(),
            'type' => $type,
            'mime' => $mime,
            'path' => $path,
            'ready_at' => Carbon::now(),
        ])->save();

        $this->delete();
        return;
    }

    /**
     * @param int $id
     * @param string $type
     * @param string $mime
     */
    protected function handleError($id, $type, $mime)
    {
        app('log')->error($error = 'Cannot move file [' . $id . '] to storage');

        $this->model->fill([
            'error' => $error,
            'size' => '0',
            'name' => 'error',
            'type' => $type,
            'mime' => $mime,
            'path' => null,
            'extension' => null,
        ]);

        if ($this->attempts() > 3) {
            $this->model->ready_at = Carbon::now();
            $this->delete();
        } else {
            $this->failed();
        }

        $this->model->save();
        return;
    }
}
