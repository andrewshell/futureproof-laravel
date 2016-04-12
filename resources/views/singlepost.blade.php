<!DOCTYPE html>
<html>
<head>
    <title>DisplaySinglePost</title>
</head>
<body>
    @if (isset($post))
        <h1>{{ $post->getTitle() }}</h1>
        <p>{!! nl2br(e($post->getContent())) !!}</p>
    @endif
    <p><a href="/">Go back...</a></p>
</body>
</html>
