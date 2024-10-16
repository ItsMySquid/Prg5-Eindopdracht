<?php //dd($items)?><!---->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Items</title>
</head>
<body>
<main>
    @auth
    <a href="{{route('items.create')}}">Create product</a>
    @endauth

@foreach($items as $item)
    <ul>
        <li>{{$item->name}}</li>
        <li>{{$item->price}}</li>
        <li>{{$item->category->type}}</li>
        <li>{{$item->category->rarity}}</li>
        <a href="{{ route('items.show', $item->id) }}">Details</a>
        <form action="{{route('items.destroy', $item->id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="delete">
        </form>
    </ul>
@endforeach
</main>
</body>
</html>
