<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center gap-4 mb-8">
                        <a href="{{ route('product.index') }}" class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold">Add Product</h2>
                            <p class="text-sm text-gray-500">Fill in the details to add a new product</p>
                        </div>
                    </div>

                    <form action="{{ route('product.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Wireless Headphones"
                                   class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('name') ? 'border-red-500 ring-red-200' : 'border-gray-300 dark:border-gray-600' }} bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-500 italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="qty" name="qty" value="{{ old('qty') }}" placeholder="0"
                                       class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('qty') ? 'border-red-500 ring-red-200' : 'border-gray-300 dark:border-gray-600' }} bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition">
                                @error('qty')
                                    <p class="mt-1.5 text-xs text-red-500 italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Price (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="0.00" step="0.01"
                                       class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('price') ? 'border-red-500 ring-red-200' : 'border-gray-300 dark:border-gray-600' }} bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition">
                                @error('price')
                                    <p class="mt-1.5 text-xs text-red-500 italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Owner <span class="text-red-500">*</span>
                            </label>
                            <select id="user_id" name="user_id" 
                                    class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('user_id') ? 'border-red-500 ring-red-200' : 'border-gray-300 dark:border-gray-600' }} bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition">
                                <option value="" disabled selected>-- Select Owner --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1.5 text-xs text-red-500 italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('product.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-sm transition">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>