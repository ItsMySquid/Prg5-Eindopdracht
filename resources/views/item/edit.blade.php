<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Item</title>
</head>
<body>
<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-lg text-white">
            <div class="mb-4">
                <a href="{{ route('items.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    Back to item
                </a>
            </div>

            <form action="{{ route('items.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}"
                           class="text-xl bg-gray-700 border-none rounded-md text-white p-2 w-full">

                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-lg font-semibold">Price:</label>
                    <input type="number" id="price" name="price" value="{{ old('price'), $item->price }}"
                           class="text-2xl bg-gray-700 border-none rounded-md text-white p-2 w-full">

                    @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
</body>
</html>
