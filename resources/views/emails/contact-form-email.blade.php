@component('mail::message')
# Contact Form Submission

填表人: {{ $contact['name'] }}

Email: {{ $contact['email'] }}

電話: {{ $contact['phone'] }}

訊息: {{ $contact['message'] }}

@component('mail::button', ['url' => ''])
按鈕文字
@endcomponent

感謝,<br>
{{ config('app.name') }}
@endcomponent
