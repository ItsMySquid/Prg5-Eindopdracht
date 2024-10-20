<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail</title>
</head>
<body>
<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-lg text-white">
            <h1 class="text-3xl font-bold mb-4">{{ $item->name }}</h1>

            <div class="mb-4">
                <span class="block text-lg font-semibold">Price:</span>
                <p class="text-2xl">{{ number_format($item->price, 0, ',', '.') }} coins</p>
            </div>

            <div class="mb-4">
                <span class="block text-lg font-semibold">Category:</span>
                <p class="text-xl">{{ $item->category->type }}</p>
            </div>

            <div class="mb-4">
                <span class="block text-lg font-semibold">Rarity:</span>
                <p class="text-xl font-bold">{{ $item->category->rarity }}</p>
            </div>

            <div class="flex space-x-4 mt-6">
                <a href="{{ route('items.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    Back to list
                </a>

                @auth
                <a href="{{ route('items.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">
                    Edit item
                </a>
                @endauth

                <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md cursor-pointer">
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
</body>
</html>
