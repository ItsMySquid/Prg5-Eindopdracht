<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-8">
        @foreach($items as $item)
            <div class="bg-gray-800 p-4 rounded-md shadow-md mb-4 text-white flex justify-between items-center">
                <div class="flex space-x-4">
                    <span><strong>Name:</strong> {{ $item->name }}</span>
                    <span><strong>Price:</strong> {{ number_format($item->price, 0, ',', '.') }} coins</span>
                </div>

                <div class="flex items-center space-x-4">

                    <a href="{{ route('items.show', $item->id) }}" class="text-blue-400 hover:underline">Details</a>

                    <form action="{{ route('items.toggleStatus', $item->id) }}" method="POST" class="inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="bg-{{ $item->status ? 'green' : 'red' }}-500 text-white px-4 py-2 rounded-md">
                            {{ $item->status ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>


                    @auth
                        <form action="{{ route('items.destroy', $item->id) }}" method="post" class="inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 cursor-pointer">
                        </form>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
