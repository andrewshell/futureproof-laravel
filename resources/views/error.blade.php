<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
</head>
<body>
    <h1>An Error Occured</h1>
    @if (isset($message))
        <p>{{ $message }}</p>
    @endif
    <p><a href="/">Go home...</a></p>
</body>
</html>
