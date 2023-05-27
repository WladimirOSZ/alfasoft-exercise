<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-7 max-w-3xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700">{{ $contact->name }}</h2>
            <p class="mt-4 text-sm text-gray-500">Contact: {{ $contact->contact }}</p>
            <p class="mt-1 text-sm text-gray-500">Email: {{ $contact->email }}</p>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('contacts.index') }}"
                   class="text-indigo-600 hover:text-indigo-900 underline">All Contacts</a>

                <div>
                    <a href="{{ route('contacts.edit', $contact) }}"
                       class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-1 px-2 rounded mr-2">Edit</a>

                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                onclick="return confirm('Are you sure you want to delete this contact?')">Delete Contact</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
