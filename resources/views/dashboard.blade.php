<x-app-layout>
    {{-- <x-slot name="header">

    </x-slot> --}}

    <div class="container mx-auto px-10 py-7">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            {{-- title --}}
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Contact List</h1>


                    {{-- flash message --}}
                    @if (session('message'))
                        <h3 class="text-2xl font-bold">{{ session('message') }}</h3>
                    @endif

                </div>

                <a href="{{ route('contacts.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-center">
                    Add Contact
                </a>


            </div>
            @if ($contacts->isNotEmpty())
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Contact</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="border px-4 py-2">{{ $contact->name }}</td>
                                <td class="border px-4 py-2">{{ $contact->contact }}</td>
                                <td class="border px-4 py-2">{{ $contact->email }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('contacts.show', $contact) }}"
                                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-center">
                                        View
                                    </a>
                                    <a href="{{ route('contacts.edit', $contact) }}"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-center inline-block">
                                        Edit
                                    </a>

                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                            onclick="return confirm('Are you sure you want to delete this contact?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No contacts yet. Add a contact.</p>
            @endif
        </div>
    </div>

</x-app-layout>
