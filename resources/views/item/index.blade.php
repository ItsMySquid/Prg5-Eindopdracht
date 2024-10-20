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
    <x-app-layout>
        <div class="p-12">
            <div class="container mx-auto">
            @auth
                @auth
                    <div class="mb-4">
                        <a href="{{route('items.create')}}" class="inline-block bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                            Create product
                        </a>
                    </div>
                @endauth

            @endauth

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-white">
                    @foreach($items as $item)
                        <div class="bg-gray-800 p-4 rounded-md shadow-md">
                            <p>{{$item->name}}</p>
                            <p>{{ number_format($item->price, 0, ',', '.') }}</p>
                            <p>{{$item->category->type}}</p>
                            <p>{{$item->category->rarity}}</p>
                            <a href="{{ route('items.show', $item->id) }}" class="text-blue-400 hover:underline">Details</a>
                            <form action="{{route('items.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="delete" class="bg-red-500 text-white px-4 py-2 mt-2 rounded-md hover:bg-red-600">
                            </form>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>


    </x-app-layout>
</main>
</body>
</html>
