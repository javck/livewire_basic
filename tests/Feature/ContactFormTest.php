<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\ContactForm;
use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;

class ContactFormTest extends TestCase
{
    public function test_the_page_contain_contact_form_livewire_component()
    {
        $this->get('/form-validate')
            ->assertSeeLivewire('contact-form');
    }

    public function test_form_sends_out_an_email()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Goblin')
            ->set('email', 'demo@goblinlab.org')
            ->set('phone', '0911234567')
            ->set('message', 'Today is my day!!')
            ->call('submitForm')
            ->assertSee('我們已經收到你的訊息，將盡快與你聯絡，感謝!');

        Mail::assertSent(function (ContactFormMailable $mail) {
            $mail->build();

            return $mail->hasTo('info@goblinlab.org') &&
                $mail->hasFrom('demo@goblinlab.org') &&
                $mail->subject == '聯絡表單通知';
        });
    }

    public function test_form_name_field_is_required()
    {
        Livewire::test(ContactForm::class)
            ->set('email', 'demo@goblinlab.org')
            ->set('phone', '0911234567')
            ->set('message', 'Today is my day!!')
            ->call('submitForm')
            ->assertHasErrors(['name' => 'required']);
    }

    public function test_form_message_field_has_minium_chars()
    {
        Livewire::test(ContactForm::class)
            ->set('message', 'abc')
            ->assertHasErrors(['message' => 'min']);
    }
}
