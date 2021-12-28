<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\MailNotification;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function addProduct($id){
        $email = User::find($id)->email;
        Mail::to($email)->send(new MailNotification('addProduct',$email));
        return 'Email Sended';
    }
    public function test(){
        $email = User::find(1)->email;
        Mail::to($email)->send(new MailNotification('addProduct',$email));
        return 'email sended';
    }
    public static function invoice($id){
        $email = User::find($id)->email;
        Mail::to($email)->send(new MailNotification('invoice',$email));
        return 'email sended';
    }
    public static function paid($id){
        $email = User::find($id)->email;
        Mail::to($email)->send(new MailNotification('paid',$email));
        return 'email sended';
    }
}
