<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailTestController extends Controller
{
    public function sendTest()
    {
        Mail::to('jperezzuferri@gmail.com')->send(new TestMail());
        return 'Correo de prueba enviado a jperezzuferri@gmail.com';
    }
}
