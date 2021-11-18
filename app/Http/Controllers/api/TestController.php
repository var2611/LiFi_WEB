<?php


namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class TestController extends Controller
{
    public function demoV()
    {
//        checkOutMissingEntry();

//        (new FreeLifiWifiController())->fetchPublicWiFiData();

        $additional_data = DB::select("select count(id)                                              as 'total_season',
       (select count(id)
        from import_public_wifi_season_data
        where date(login_start_time) = subdate(curdate(), 1)) as 'last_day_season',
       round(sum(download_data) / 1024 / 1024 / 1024)         as 'total_download_data',
       (select round(sum(download_data) / 1024 / 1024 / 1024)
        from import_public_wifi_season_data
        where date(login_start_time) = subdate(curdate(), 1)) as 'last_day_download_data',
       round(sum(session_time) / 60 / 60)                     as 'total_usage_time',
       (select round(sum(session_time) / 60 / 60)
        from import_public_wifi_season_data
        where date(login_start_time) = subdate(curdate(), 1)) as 'last_day_usage_time'
from import_public_wifi_season_data");

        echo $additional_data[0]->total_season;

//        $total_season = ImportPublicWifiSeasonData::get()->count();
//        $total_users = ImportPublicWifiSeasonData::distinct()->get('mobile')->count();
//        $total_download_data = ImportPublicWifiSeasonData::sum('download_data');
//        $total_usage_time = ImportPublicWifiSeasonData::sum('session_time');
//        $today_season = ImportPublicWifiSeasonData::whereDate('login_start_time', getYesterdayDate())->get()->count();
//
//        echo $total_season . '  //  ' . $total_users . '  //  ' . ($total_download_data/1024/1024/1024) . ' // ' . $total_usage_time/60/60 . ' // ' . $today_season;
    }

    public function new_mail()
    {

        $details = [
            'to' => 'var2611@gmail.com',
            'from' => 'info@navtechno.in',
            'subject' => 'Test 1',
            'title' => 'Test Title',
            "body" => 'Test Body'
        ];

//        Mail::to('var2611@gmail.com')->send(new Mailer($details));
//
//        if (Mail::failures()) {
//            $result = response()->json([
//                'status' => false,
//                'data' => $details,
//                'message' => 'Nnot sending mail.. retry again...'
//            ]);
//
//            echo "Fail : " . json_encode($result);
//        }
//        $result = response()->json([
//            'status' => true,
//            'data' => $details,
//            'message' => 'Your details mailed successfully'
//        ]);
//
//        echo json_encode($result);

        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername('info@navtechno.in')
            ->setPassword('czwwdfstliobrbnk');

// Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

// Create a message
        $message = (new Swift_Message('News Letter Subscription'))
            ->setFrom(['info@navtechno.in' => 'A Name'])
            ->setTo(['var2611@gmail.com' => 'A Name'])
            ->setBody('your message body');

// Send the message
        $result = $mailer->send($message);

        echo json_encode($result);

//        Mail::send('email.contact', array('key' => 'value'), function($message)
//        {
//            $message->to('var2611@gmail.com', 'Sender Name')->subject('Welcome!');
//        });

    }

}
