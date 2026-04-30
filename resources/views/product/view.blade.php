<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-[60vh]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/70 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-700">
                <div class="p-8 text-gray-100">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('product.index') }}" class="p-2 rounded-md text-gray-400 hover:bg-gray-700 transition">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                            </a>
                            <div>
                                <h2 class="text-2xl font-semibold">Product Details</h2>
                                <p class="text-sm text-gray-400 italic">Viewing product #{{ $product->id }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            @can('update', $product)
                                <a href="{{ route('product.edit', $product->id) }}" class="px-3 py-1.5 text-xs font-medium text-gray-900 bg-yellow-400 rounded hover:bg-yellow-500">Edit</a>
                            @endcan

                            @can('delete', $product)
                                <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="bg-gray-700/30 rounded-xl border border-gray-700 overflow-hidden">
                        <div class="divide-y divide-gray-700">
                            <!-- Name -->
                            <div class="grid grid-cols-3 px-6 py-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Product Name</div>
                                <div class="col-span-2 text-sm font-semibold">{{ $product->name }}</div>
                            </div>
                            
                            <!-- Quantity -->
                            <div class="grid grid-cols-3 px-6 py-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</div>
                                <div class="col-span-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->qty > 10 ? 'bg-green-100 text-green-800' : ($product->qty > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $product->qty }} {{ $product->qty > 10 ? 'In Stock' : ($product->qty > 0 ? 'Low Stock' : 'Out of Stock') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="grid grid-cols-3 px-6 py-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Price</div>
                                <div class="col-span-2 text-sm font-mono font-bold text-indigo-600 dark:text-indigo-400">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- Owner -->
                            <div class="grid grid-cols-3 px-6 py-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Owner</div>
                                <div class="col-span-2 flex items-center gap-2">
                                    <div class="h-6 w-6 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-bold text-indigo-700 uppercase">
                                        {{ substr($product->user->name ?? '?', 0, 1) }}
                                    </div>
                                    <span class="text-sm">{{ $product->user->name ?? 'None' }}</span>
                                </div>
                            </div>

                            <!-- Created At -->
                            <div class="grid grid-cols-3 px-6 py-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</div>
                                <div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $product->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>

                            <!-- Updated At -->
                            <div class="grid grid-cols-3 px-6 py-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</div>
                                <div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $product->updated_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>