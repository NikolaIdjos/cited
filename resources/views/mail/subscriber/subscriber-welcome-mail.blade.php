@component('mail::message')
<center>
    Welcome!
    <br>
    Your account is activated!
    <br>
    You will receive new quotes every day.
</center>
@component('mail::button', ['url' =>  $url, 'color' => 'success'])
    Deactivate
@endcomponent
<center>
    Thank You,<br>
    <b> {{ config('app.name') }}</b>
</center>
@endcomponent
