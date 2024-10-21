<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg text-white">
            <h1 class="text-3xl font-bold mb-4">User's Items</h1>

            @if ($items->isEmpty())
                <p>No items found for this user.</p>
            @else
                <ul class="space-y-4">
                    @foreach($items as $item)
                        <li class="p-4 bg-gray-700 rounded-md">
                            <h2 class="text-xl font-semibold">{{ $item->name }}</h2>
                            <p class="text-lg">Price: {{ number_format($item->price, 0, ',', '.') }} coins</p>
                            <a href="{{ route('items.show', $item->id) }}" class="text-blue-400 hover:text-blue-500">View Details</a>
                        </li>
                    @endforeach
                </ul>
            @endif
                <div class="mb-4 py-4">
                    <a href="{{route('items.create')}}"
                       class="inline-block bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Create product
                    </a>
                </div>
        </div>
    </div>
</x-app-layout>
