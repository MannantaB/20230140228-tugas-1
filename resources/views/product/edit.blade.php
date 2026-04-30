<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-[60vh]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/70 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-700">
                <div class="p-8 text-gray-100">
                    <div class="flex items-center gap-4 mb-8">
                        <a href="{{ route('product.index') }}" class="p-2 rounded-md text-gray-400 hover:bg-gray-700 transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-semibold">Edit Product</h2>
                            <p class="text-sm text-gray-400">Modify the product details</p>
                        </div>
                    </div>

                    <form action="{{ route('product.update', $product->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="e.g. Wireless Headphones"
                                   class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('name') ? 'border-red-500 ring-red-200' : 'border-gray-600' }} bg-gray-900 text-gray-100 focus:ring-4 focus:ring-purple-900/20 focus:border-purple-600 outline-none transition">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-400 italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-300 mb-1">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="qty" name="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="0"
                                       class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('quantity') ? 'border-red-500 ring-red-200' : 'border-gray-600' }} bg-gray-900 text-gray-100 focus:ring-4 focus:ring-purple-900/20 focus:border-purple-600 outline-none transition">
                                @error('quantity')
                                    <p class="mt-1.5 text-xs text-red-400 italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-300 mb-1">
                                    Price (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="0.00" step="0.01"
                                       class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('price') ? 'border-red-500 ring-red-200' : 'border-gray-600' }} bg-gray-900 text-gray-100 focus:ring-4 focus:ring-purple-900/20 focus:border-purple-600 outline-none transition">
                                @error('price')
                                    <p class="mt-1.5 text-xs text-red-400 italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-300 mb-1">
                                Category
                            </label>
                            <select id="category_id" name="category_id"
                                    class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('category_id') ? 'border-red-500 ring-red-200' : 'border-gray-600' }} bg-gray-900 text-gray-100 focus:ring-4 focus:ring-purple-900/20 focus:border-purple-600 outline-none transition">
                                <option value="" selected>-- None --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1.5 text-xs text-red-400 italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-300 mb-1">
                                Owner <span class="text-red-500">*</span>
                            </label>
                            <select id="user_id" name="user_id" 
                                    class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('user_id') ? 'border-red-500 ring-red-200' : 'border-gray-600' }} bg-gray-900 text-gray-100 focus:ring-4 focus:ring-purple-900/20 focus:border-purple-600 outline-none transition">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $product->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1.5 text-xs text-red-400 italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('product.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-300 bg-gray-900 border border-gray-700 rounded-lg hover:bg-gray-800 transition">
                                Cancel
                            </a>
                            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 shadow transition">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>