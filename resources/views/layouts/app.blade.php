<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title : 'Nome App' }}</title>
</head>
<body>
    <div>
        <nav>
            <ul>
                @if(auth()->check())
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Registrati</a></li>
                @endif
            </ul>
        </nav>

        <div>
            @if(isset($content))
                {{ $content }}
            @endif
        </div>
    </div>
</body>
</html>
