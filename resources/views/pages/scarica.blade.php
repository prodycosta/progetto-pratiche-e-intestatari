<!DOCTYPE html>
<html>

<head>
    <title>Scarica Allegato</title>
</head>

<body>
    <h2>Scarica Allegato</h2>
    <p><a href="{{ route('allegato.visualizza', ['id_allegato' => $allegato->id]) }}">Visualizza Allegato</a></p>
    <a href="{{ route('allegato.scarica', ['id_allegato' => $allegato->id]) }}">Scarica Allegato</a>
</body>

</html>
