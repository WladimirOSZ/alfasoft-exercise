@csrf
<div class="space-y-12 p-6">
    <div>
        <h2 class="text-lg leading-6 font-medium text-gray-900">Create a new contact</h2>
        <p class="mt-1 text-sm text-gray-500">Contact info</p>
    </div>
    <div class="mt-6 space-y-6 sm:mt-5">
        <div class="space-y-1">
            <label for="contact-name" class="block text-sm font-medium text-gray-700">Contact name</label>
            <div class="mt-1">
                <input type="text" name="name" id="contact-name" value="{{ old('name', $contact->name ?? '') }}"
                    autocomplete="given-name"
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="space-y-1">
            <label for="contact-phone" class="block text-sm font-medium text-gray-700">Phone number</label>
            <div class="mt-1">
                <input type="text" name="contact" id="contact-phone"
                    value="{{ old('contact', $contact->contact ?? '') }}" autocomplete="given-name"
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('contact')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="space-y-1">
            <label for="contact-email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
                <input type="email" name="email" id="contact-email"
                    value="{{ old('email', $contact->email ?? '') }}" autocomplete="email"
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
    <button type="submit"
        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Save
    </button>
</div>
