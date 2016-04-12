<!DOCTYPE html>
<html>
<head>
    <title>Default</title>
</head>
<body>
    <h1>Data</h1>
    @if (isset($__data))
        @foreach (array_keys($__data) as $k)
            @if (false === array_search($k, ['__env', 'app', 'errors']))
            <h2>{{ $k }}</h2>
            <pre><?php print_r($__data[$k]); ?></pre>
            @endif
        @endforeach
    @endif
</body>
</html>
