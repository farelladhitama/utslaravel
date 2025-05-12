<x-layouts.app :title="__('Categories')">
    <!-- Add SweetAlert for delete confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Product Categories</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Manage your product categories efficiently</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Search Form -->
                <form action="{{ route('categories.index') }}" method="get" class="w-full sm:w-64">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="q" value="{{ $q }}"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Search categories...">
                    </div>
                </form>

                <!-- Add New Button -->
                <flux:button icon="plus"
                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white">
                    <flux:link href="{{ route('categories.create') }}" variant="subtle">Add New Category</flux:link>
                </flux:button>
            </div>
        </div>

        <!-- Success Message -->
        @if (session()->has('successMessage'))
            <div
                class="mb-6 p-4 bg-green-50 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-200 rounded">
                {{ session()->get('successMessage') }}
            </div>
        @endif

        <!-- Categories Table -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Image
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Slug
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Created
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($category->image)
                                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                            class="h-10 w-10 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div
                                            class="h-10 w-10 bg-gray-100 dark:bg-gray-600 flex items-center justify-center rounded-lg">
                                            <svg class="h-6 w-6 text-gray-400 dark:text-gray-300" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $category->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $category->slug }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-gray-300 line-clamp-2 max-w-xs">
                                        {{ $category->description }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $category->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <flux:dropdown>
                                        <flux:button icon:trailing="chevron-down"
                                            class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                            Actions</flux:button>
                                        <flux:menu class="w-40">
                                            <flux:menu.item icon="pencil"
                                                href="{{ route('categories.edit', $category->id) }}">Edit
                                            </flux:menu.item>
                                            <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                                            <flux:menu.item icon="trash" variant="danger"
                                                onclick="confirmDelete('{{ $category->id }}', '{{ $category->name }}')">
                                                Delete
                                            </flux:menu.item>
                                            <form id="delete-form-{{ $category->id }}"
                                                action="{{ route('categories.destroy', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Showing <span class="font-medium">{{ $categories->firstItem() }}</span> to <span
                        class="font-medium">{{ $categories->lastItem() }}</span> of <span
                        class="font-medium">{{ $categories->total() }}</span> results
                </div>
                <div class="flex space-x-2">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(categoryId, categoryName) {
            Swal.fire({
                title: 'Hapus Kategori',
                html: `Apakah Kamu Yakin Ingin Menghapus <strong>${categoryName}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak',
                backdrop: `
                rgba(0,0,0,0.7)
                url("/images/trash-icon.png")
                center top
                no-repeat
            `,
                customClass: {
                    popup: 'dark:bg-gray-800 dark:text-white',
                    confirmButton: 'hover:bg-red-700',
                    cancelButton: 'hover:bg-gray-200 dark:hover:bg-gray-700'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${categoryId}`).submit();
                }
            });
        }
    </script>
</x-layouts.app>
