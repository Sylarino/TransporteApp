<?php

namespace App\Http\Exports\Jobs;

use App\Domain\System\User\User;
use App\Domain\User\Export\ExportReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class NotifyExportLinkToUserInMail implements ShouldQueue
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
        $this->sendMail($this->user,$exportReminder);
    }

    public function sendEmail($user,$reminder)
    {
        Mail::send('emails.export.export-completed', [
            'user' => $user,
            'reminder' => $reminder
        ], function ($message) use ($user){
            $message->from('sai@metaproject.cl', 'Sistema de Administracion de Contratos');
            $message->to($user->email, $user->full_name);
            $message->subject("Archivo creado, listo para descargar.");
        });
    }
}
