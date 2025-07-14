<!DOCTYPE html>
<html>
    <head>
        <title>{{ $data['title'] }}</title>
    </head>
    <body>
        <p>{{ $data['body'] }}</p>
        <a href="{{ $data['url'] }}">
            {{ $data['link_text'] ?? 'Click here to view more' }}
        </a>
        <p>Thank you!</p>
    </body>
</html>