@component('mail::message')
# Introduction

The body of your message.

Message Test

@component('mail::button', ['url' => url('/')])
Click Here to go {{$message}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
