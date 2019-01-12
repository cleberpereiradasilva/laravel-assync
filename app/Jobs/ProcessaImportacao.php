<?php

namespace App\Jobs;

use App\Http\Controllers\UploadController;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessaImportacao implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $uploadController, $path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UploadController $uploadController, $path)
    {
        $this->uploadController = $uploadController;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "Iniciando o processamento de algo...". PHP_EOL;
        $this->uploadController->importarPares($this->path);
        echo "... finalizado". PHP_EOL;
    }
}
