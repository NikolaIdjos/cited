@component('mail::message')
<center>
    Your account is deactivated!
    <br>
    If you would like to activate your account press the button below.
</center>
@component('mail::button', ['url' => config('app.url').'/status/subscribers/'.$subscriber->id.'/ACTIVE', 'color' => 'success'])
    Reactivate
@endcomponent
<center>
    Thank You,<br>
    <b> {{ config('app.name') }}</b>
</center>
@endcomponent
