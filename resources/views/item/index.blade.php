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
                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="container mx-auto flex justify-between mb-8">
                    <!-- Filter functie links -->
                    <form method="GET" action="{{ route('items.index') }}" class="bg-gray-800 p-4 rounded-lg shadow-md text-white w-1/3">
                        <label for="category" class="block text-lg font-semibold mb-2">Filter by Category</label>
                        <select name="category_id" id="category" class="w-full p-2 mb-4 bg-gray-700 text-white rounded-md">
                            <option value="">All Categories</option>
                            @foreach($category as $categoryItem)
                                <option value="{{ $categoryItem->id }}" {{ request('category_id') == $categoryItem->id ? 'selected' : '' }}>
                                    {{ $categoryItem->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-primary-button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
                            Filter
                        </x-primary-button>
                    </form>

                    <!-- Zoekfunctie rechts -->
                    <form method="GET" action="{{ route('items.index') }}" class="bg-gray-800 p-4 rounded-lg shadow-md text-white w-1/3">
                        <label for="search" class="block text-lg font-semibold mb-2">Search Items</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               placeholder="Enter search term"
                               class="w-full p-2 mb-4 bg-gray-700 text-white rounded-md">
                        <x-primary-button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
                            Search
                        </x-primary-button>
                    </form>
                </div>




                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-white">
                    @foreach($items as $item)
                        <div class="bg-gray-800 p-4 rounded-md shadow-md">
                            <p>{{$item->name}}</p>
                            <p>{{ number_format($item->price, 0, ',', '.') }} coins</p>
                            <p>{{$item->category->type}}</p>
                            <p>{{$item->category->rarity}}</p>
                            <a href="{{ route('items.show', $item->id) }}"
                               class="text-blue-400 hover:underline">Details</a>
                            @if(Auth::user()->is_admin || Auth::user()->id === $item->user_id)
                            <form action="{{route('items.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete"
                                       class="bg-red-500 text-white px-4 py-2 mt-2 rounded-md hover:bg-red-600">
                            </form>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        </div>


    </x-app-layout>
</main>
</body>
</html>
