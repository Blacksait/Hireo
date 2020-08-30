<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class MailController extends Controller
{
    public function send()
    {
        Mail::send(['text' =>'mail'],['name' , 'Web dev blog'] , function ($message){
            $message->to('blacksait55@gmail.com','to web dev blog')->subject('Test email');
            $message->from('blacksait55@gmail.com', 'Web dev blog');
        });
        return redirect()->back();

    }
}
