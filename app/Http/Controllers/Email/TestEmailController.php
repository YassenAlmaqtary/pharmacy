<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function sendEmail(){
        // $details=[
        //   'title'=>'مرحبا بكم',
        //   'body'=>'مرحبا بكم جميعا',

        // ];
        // Mail::to('azzaalmekhlafi123321@gmail.com')->send(new TestMail($details));
        // return "mail send";

      

    }


}
