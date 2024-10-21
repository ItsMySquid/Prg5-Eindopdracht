<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-lg text-white">
            <h1 class="text-3xl font-bold mb-4">Create New Item</h1>

            <form action="{{route('items.store')}}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Name:</label>
                    <input type="text" id="name" name="name" class="text-xl bg-gray-700 border-none rounded-md text-white p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-lg font-semibold">Price:</label>
                    <input type="number" id="price" name="price" class="text-2xl bg-gray-700 border-none rounded-md text-white p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-lg font-semibold">Category:</label>
                    <select name="category_id" id="category" class="w-full p-2 bg-gray-700 text-white rounded-md">
                        @foreach($category as $categoryItem)
                            <option value="{{ $categoryItem->id }}" {{ request('category_id') == $categoryItem->id ? 'selected' : '' }}>
                                {{ $categoryItem->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                        Create Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
