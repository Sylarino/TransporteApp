<?php

namespace App\Http\Exports\Jobs;

use App\Domain\System\User\User;
use App\Domain\User\Export\ExportReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class NotifyExportLinkToUserInApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public $file_name;

    public function __construct($file_name,User $user)
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
        $exportReminder = ExportReminder::where('user_id',$this->user->id)
                ->where('file',$this->file_name)->first();
        $exportReminder->is_created = 1;
        $exportReminder->save();
    }


}
