<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;

class ExampleController extends Controller
{
    public function form_validate()
    {
        return view('examples.form-validation');
    }

    public function sendMail(Request $request)
    {
        $contact = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        Mail::to('info@goblinlab.org')->send(new ContactFormMailable($contact));

        //返回並以 Session 來傳送訊息
        return back()->with('successMessage', '我們已經收到你的訊息，將盡快與你聯絡，感謝!');
    }
}
