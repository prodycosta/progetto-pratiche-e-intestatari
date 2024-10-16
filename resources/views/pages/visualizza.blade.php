<!DOCTYPE html>
<html>

<head>
    <title>Visualizza Allegato</title>
</head>

<body>

    <h2>Visualizza Allegato</h2>

    <embed src="{{ route('allegato.visualizza', ['id_allegato' => $allegato->id]) }}" type="{{ $allegato->tipo_mime }}" width="100%" height="600px" />

    <p><a href="{{ route('allegato.scarica', ['id_allegato' => $allegato->id]) }}">Scarica Allegato</a></p>

</body>

</html>
