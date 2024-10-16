<x-app-layout>
    <form action="{{route('items.store')}}" method="post">
        @csrf
        <div>
            <x-input-label for="name">Name</x-input-label>
            <x-text-input name="name" id="name"></x-text-input>
        </div>
        <div>
            <x-input-label for="price">price</x-input-label>
            <x-text-input type="number" name="price" id="price"></x-text-input>
        </div>
        <x-primary-button type="submit">Create</x-primary-button>
    </form>
</x-app-layout>
