<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\EventRegistration;
use Carbon\Carbon;

class MarkAbsentUsers extends Command
{
    protected $signature = 'events:mark-absent';
    protected $description = 'Mark users as absent for events if they have not checked in after 15 minutes of the event start time.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Lấy tất cả sự kiện đã bắt đầu và vượt qua 15 phút nhưng chưa kết thúc
        $events = Event::where('date', '<=', $now->subMinutes(15))->get();

        foreach ($events as $event) {
            $affectedRows = EventRegistration::where('event_id', $event->id)
                ->whereNull('status') // Chỉ cập nhật những user chưa check-in
                ->update(['status' => 'absent']);

            $this->info("Marked {$affectedRows} users as absent for event ID: {$event->id}");
        }

        $this->info('All applicable users marked as absent successfully.');
        return 0;
    }
}
