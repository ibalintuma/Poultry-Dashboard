<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendCalendarReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:calendar-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'calender reminder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       /* $today_calendars = \App\Models\Calender::whereDate('date', now()->toDateString())
         ->where('status', 'pending')
         ->get(); */


        $upcoming_calendars = \App\Models\Calender::whereBetween('date', [now()->toDateString(), now()->addDays(3)->toDateString()])
        //$upcoming_calendars = \App\Models\Calender::whereDate("date", ">=", now()->toDateString())->whereDate('date', '<=', now()->addDays(3)->toDateString())
          ->where('status', 'pending')
          ->get();

        $message = "Poultry Events Reminder:\n\n";
        foreach ($upcoming_calendars as $calendar) {
          $date = \Carbon\Carbon::parse($calendar->date)->format('F j, Y');
          $type = $calendar->type;
          $title = $calendar->title;
          $amount = $calendar->amount;
          $message .= "Date: $date\nType: $type\nTitle: $title\nCosting Amount: UGX $amount\n\n";
        }

        $contacts = \App\Models\Contact::where('enable_sms_notifications', true)->whereNotNull('phone')->get();
        foreach ($contacts as $contact) {
          $phone = $this->fixPhoneNumber($contact->phone);
          $this->sendSMS($phone, $message);
        }

    }


  private function fixPhoneNumber($p)
  {
    $phone = $p;

    if (substr($phone, 0, 1) == "+") {
      return $phone;
    } else if (substr($phone, 0, 2) == "07") {
      $phone = "+256" . substr($phone, 1);
    } else if (substr($phone, 0, 1) == "0") {
      $phone = "+256" . substr($phone, 1);
    } else if (substr($phone, 0, 1) == "7") {
      $phone = "+256" . $phone;
    } else if (substr($phone, 0, 3) == "256") {
      $phone = "+" . $phone;
    }

    return $phone;
  }



  public function sendSMS(string $phone, string $comment)
  {

    if (substr($phone, 0, 2) == "07") {
      $phone = "+256" . substr($phone, 1);
    }
    if (substr($phone, 0, 1) == "0") {
      $phone = "+256" . substr($phone, 1);
    }
    if (substr($phone, 0, 1) == "7") {
      $phone = "+256" . $phone;
    }
    if (substr($phone, 0, 4) == "256") {
      $phone = "+" . $phone;
    }

    $response = Http::get("https://www.egosms.co/api/v1/plain/?number=".$phone."&message=".str_replace(" ","+",$comment)."& username=ibalintuma&password=VJvQ@78HRFe9H&sender=Egosms&priority=0");
    if ($response->successful()) {
      return $response->body();
    } else {
      return 'Error: ' . $response->status();
    }
  }
}
