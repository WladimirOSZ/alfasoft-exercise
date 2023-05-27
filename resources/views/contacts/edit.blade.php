<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-7 max-w-3xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form method="POST" action="{{route('contacts.update', $contact)}}">
                @method('PUT')
                @include('contacts.form', ['contact' => $contact])
            </form>
        </div>
    </div>
</x-app-layout>
