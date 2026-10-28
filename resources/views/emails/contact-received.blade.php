<x-mail::message>
# New contact form submission

Someone submitted the portfolio contact form. Full details below.

**Name:** {{ $senderName }}  
**Email:** {{ $senderEmail }}  
**Subject:** {{ $subjectLine }}

**Message:**  
{{ $bodyMessage }}

You can reply directly to this email to respond to **{{ $senderName }}**.
</x-mail::message>
