<x-mail::message>
# New portfolio message

**From:** {{ $senderName }} &lt;{{ $senderEmail }}&gt;  
**Subject:** {{ $subjectLine }}

{{ $bodyMessage }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
