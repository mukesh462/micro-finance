<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Podcast processing...');
        for ($i = 0; $i < 10; $i++) {
            sleep(2);
            $q =  "INSERT INTO `centers` (`id`, `center_name`, `center_address`, `employee_id`, `center_type`, `formation_date`, `meeting_date`, `meeting_time`, `meeting_day`, `meeting_place`, `day_in_number`, `mobile_number`, `created_at`, `updated_at`) VALUES (NULL, 'Madurai', 'Madurai', '1', '0', '21-02-2024', '08-02-2024', '12:35 PM', 'Thursday', 'nice', '0', '97151652090', '2024-02-20 09:55:15', '2024-02-20 09:55:15'), (NULL, 'Tirupur', 'Tirupur', '2', '0', '22-02-2024', '31-01-2024', '12:25 AM', 'Wednesday', 'nice', '0', '97151652090', '2024-02-20 09:55:53', '2024-02-21 07:58:03')";
            DB::raw($q);
        }
    }
}
