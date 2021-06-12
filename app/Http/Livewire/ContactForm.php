<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $success_message;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'message' => 'required|min:5',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.contact-form');
    }

    public function submitForm()
    {
        $contact = $this->validate();

        sleep(1);

        Mail::to('info@goblinlab.org')->send(new ContactFormMailable($contact));

        //重置表單
        $this->reset(['name', 'email', 'phone', 'message']);

        $this->success_message = '我們已經收到你的訊息，將盡快與你聯絡，感謝!';
    }
}
