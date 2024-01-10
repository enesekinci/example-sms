<?php

namespace App\Jobs;

use App\Enums\SmsStatus;
use App\Models\SMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public SMS $sms)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Sms gönderim apisine gelen 500 adet sms sonrası job ile
        //gönderim sağlanması kurgusunun yapılması(geliştirilmesi)

        $waitingSms = SMS::query()->where('status', SmsStatus::WAITING)->limit(500)->get();

        if ($waitingSms->count() < 500) {
            return;
        }

        foreach ($waitingSms as $sms) {
            $sms->update([
                'status' => SmsStatus::SENT,
            ]);
        }
    }
}
