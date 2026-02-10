<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Приглашение</title>
</head>
<body>
    <h2>Вас пригласили в компанию {{ $invite->company->name }}</h2>

    <p>
        Вас пригласили зарегистрироваться как
        <strong>{{ $invite->role }}</strong>.
    </p>

    <p>
        Для регистрации перейдите по ссылке:
    </p>

    <p>
        <a href="{{ route('invite.register.show', $invite->token) }}">
            Принять приглашение
        </a>
    </p>

    <p>
        Ссылка действует до: {{ $invite->expires_at->format('d.m.Y H:i') }}
    </p>
</body>
</html>
