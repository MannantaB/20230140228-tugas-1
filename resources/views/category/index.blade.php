<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-[60vh]">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/70 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-700">
                <div class="p-8 text-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-semibold">Category List</h2>
                            <p class="text-sm text-gray-400">Manage your category</p>
                        </div>
                        <a href="{{ route('category.create') }}"
                           class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-full hover:bg-purple-700 shadow transition">
                            + Add Category
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($categories->isEmpty())
                        <p class="text-center text-gray-400 py-12">No categories yet. Add the first one!</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-gray-700 text-gray-300 uppercase text-xs">
                                    <tr>
                                        <th class="px-4 py-3 w-12">#</th>
                                        <th class="px-4 py-3">Name</th>
                                        <th class="px-4 py-3 text-center">Total Product</th>
                                        <th class="px-4 py-3 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    @foreach ($categories as $index => $category)
                                        <tr class="hover:bg-gray-700/30 transition">
                                            <td class="px-4 py-3 text-gray-400">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3 font-medium text-gray-100">{{ $category->name }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="px-2.5 py-1 text-xs font-semibold bg-purple-900/30 text-purple-200 rounded-full">
                                                    {{ $category->products_count }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('category.edit', $category) }}"
                                                       class="px-3 py-1.5 text-xs font-medium text-gray-900 bg-yellow-400 rounded hover:bg-yellow-500 transition">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('category.delete', $category->id) }}" method="POST"
                                                          onsubmit="return confirm('Hapus category ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 transition">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>