<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    function sendEmail($email){
        Mail::to($email)->send(new TestEmail());
        return redirect('/');
    }
}
