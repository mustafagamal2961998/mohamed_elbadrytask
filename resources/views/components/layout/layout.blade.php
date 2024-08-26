<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    @stack('style')
    <title>{{$title}}</title>
</head>
<body>
    @if(Session::has('success'))
        <div class="success-message-alerts-container">
            <div class="success-message-alerts-content">
                
                    {{Session::get('success')}}
                
            </div>
        </div>
    @endif
    {{$slot}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @stack('script')
</body>
</html>