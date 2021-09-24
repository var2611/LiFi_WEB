<?php


namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class TestController extends Controller
{
    public function demoV()
    {

        //2021-05-19 13:15:21
//        $todayDate = date('Y-m-d');
//        $currentDateTime = '2021-05-19 23:15:21';
//
//        $attendance = Attendance::whereFlashCode('123456')
//            ->where('date', '=', '2021-05-19')
//            ->orderByDesc('created_at')->first();
//
//        $hours_worked = (strtotime($currentDateTime) - strtotime($attendance->in_time)) / 3600;
//
//        $attendance->out_time = $currentDateTime;
//        $attendance->hours_worked = $hours_worked;
//        $attendance->updated_by = 1;
//        $attendance->save();
//
//        echo json_encode($attendance);

//        $start = strtotime('2021-05-19 21:01:00');
//        $end = strtotime('2021-05-20 7:04:00');
//        $mins = ($end - $start) / 3600;
//        echo $mins;

//        echo date('H:i:s ');
//        echo now();
//        echo "test2";
//        echo '1';

//        $mac_address = strtoupper($request->mac ?? null);
//        $user = User::where('mac_address', $mac_address)->first(['id']);

//        echo 1;

        echo json_encode(Auth::user()->UserEmployee->company_id);

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
