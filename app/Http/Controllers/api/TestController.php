<?php


namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Mail\Mailer;
use Illuminate\Http\JsonResponse;
use Mail;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class TestController extends Controller
{
    public function demoV()
    {
        echo "test";
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
