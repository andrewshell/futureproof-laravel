<!DOCTYPE html>
<html>
<head>
    <title>ListAllPosts</title>
</head>
<body>
<form method="post">
    {{ csrf_field() }}
    <p><input type="text" name="title" placeholder="Title" size="100"></p>
    <p><textarea name="content" placeholder="Content" cols="100" rows="10"></textarea></p>
    <p><textarea name="excerpt" placeholder="Excerpt (optional)" cols="100" rows="2"></textarea></p>
    <p><button type="submit">Save Post</button>
</form>
@if (isset($posts) && is_array($posts))
@foreach ($posts as $post)
    <h2>{{ $post->getTitle() }}</h2>
    <p>{{ $post->getExcerpt() }}</p>
    @if ($post->hasId())
    <p><a href="/{{ $post->getId() }}/">Read more...</a></p>
    @endif
    <hr>
@endforeach
@endif
</body>
</html>
