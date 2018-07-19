<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
class MailController extends Controller
{
    //
   public function basic_email(){
      $data = array('name'=>"Virat Gandhi",'id' => 12345);
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('khitprojectteam2015@gmail.com', 'KHIT PROJECT')->subject
            ('Confirm Account[MOT]');
         $message->from('v.vannochit@gmail.com','Virat Gandhi');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
   public function html_email(){
     $data = array('name'=>"Virat Gandhi",'id' => 12345);
      Mail::send('mail', $data, function($message) {
         $message->to('khitprojectteam2015@gmail.com', 'KHIT PROJECT')->subject
             ('Confirm Account[MOT]');
         $message->from('v.vannochit@gmail.com','Virat Gandhi');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email(){
      $data = array('name'=>"Virat Gandhi",'id' => 12345);
      Mail::send('mail', $data, function($message) {
         $message->to('khitprojectteam2015@gmail.com', 'KHIT PROJECT')->subject
              ('Confirm Account[MOT]');
         $message->attach('https://i.stack.imgur.com/kS9Kf.png');
         $message->attach('https://i.stack.imgur.com/kS9Kf.png');
         $message->from('v.vannochit@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }

}
