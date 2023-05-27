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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('contacts.edit', $contact) }}"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-center inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>

                                        Edit
                                    </a>

                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                            onclick="return confirm('Are you sure you want to delete this contact?')">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>


                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 flex justify-center">
                    {{ $contacts->links() }}
                </div>
            @else
                <p>No contacts yet. Add a contact.</p>
            @endif
        </div>
    </div>

</x-app-layout>
