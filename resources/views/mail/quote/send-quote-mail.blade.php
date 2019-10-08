@component('mail::message')
<center>
    {{$quote->description}}
</center>
@component('mail::button', ['url' => config('app.url').'/status/subscribers/'.$subscriber->id, 'color' => 'success'])
    Deactivate
@endcomponent
<center>
    Thank You,<br>
    <b> {{ config('app.name') }}</b>
</center>
@endcomponent
