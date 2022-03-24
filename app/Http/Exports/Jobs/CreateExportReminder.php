<?php

namespace App\Http\Exports\Jobs;

use App\Domain\System\User\User;
use App\Domain\User\Export\ExportReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateExportReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file_name;

    public $user;

    public function __construct($file_name, User $user)
    {
        $this->file_name = $file_name;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       ExportReminder::create([
           'user_id' => $this->user->id,
           'file' => $this->file_name,
           'is_readed' => 0,
           'is_created' => 0
       ]);
    }
}
