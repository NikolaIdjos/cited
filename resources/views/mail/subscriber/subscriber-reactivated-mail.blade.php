@component('mail::message')
<center>
    Your account is activated! If you would like to deactivate your account press the button below.
</center>
@component('mail::button', ['url' => config('app.url').'/status/subscribers/'.$subscriber->id, 'color' => 'success'])
    Deactivate
@endcomponent
<center>
    Thank You,<br>
    <b> {{ config('app.name') }}</b>
</center>
@endcomponent
