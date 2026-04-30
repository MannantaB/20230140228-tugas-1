<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-[60vh]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/70 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-700">
                <div class="p-8 text-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-semibold">Product List</h2>
                            <p class="text-sm text-gray-400">Manage your product inventory</p>
                        </div>
                        <a href="{{ route('product.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-full hover:bg-purple-700 shadow transition">+ Add Product</a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-700 text-gray-300 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3 w-12">#</th>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Quantity</th>
                                    <th class="px-4 py-3">Price</th>
                                    <th class="px-4 py-3">Owner</th>
                                    <th class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($products as $product)
                                    <tr class="hover:bg-gray-700/30 transition">
                                        <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-100">{{ $product->name }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $product->qty > 0 ? 'bg-green-900/30 text-green-200' : 'bg-red-900/30 text-red-200' }}">{{ $product->qty }} {{ $product->qty > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-200">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-gray-200">{{ $product->user->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center gap-3">
                                                <a href="{{ route('product.show', $product->id) }}" class="text-indigo-300 hover:text-indigo-100" title="View">View</a>
                                                @can('update', $product)
                                                    <a href="{{ route('product.edit', $product->id) }}" class="px-3 py-1.5 text-xs font-medium text-gray-900 bg-yellow-400 rounded hover:bg-yellow-500 transition">Edit</a>
                                                @endcan
                                                @can('delete', $product)
                                                    <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Silahkan konfirmasi untuk menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 transition">Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">No products found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>