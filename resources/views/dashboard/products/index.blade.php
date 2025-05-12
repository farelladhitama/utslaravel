<x-layouts.app :title="__('Products')">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Products Management</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Manage your product inventory efficiently</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 items-start">
                <!-- Search Form -->
                <form action="{{ route('products.index') }}" method="get" class="w-full sm:w-64">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="q" value="{{ $q ?? ''}}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Search products...">
                    </div>
                </form>
                
                <!-- Add New Button -->
                <flux:button icon="plus" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white">
                    <flux:link href="{{ route('products.create') }}" variant="subtle" class="whitespace-nowrap">Add New Product</flux:link>
                </flux:button>
            </div>
        </div>

        <!-- Success Message -->
        @if(session()->has('successMessage'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-200 rounded">
                {{ session()->get('successMessage') }}
            </div>
        @endif

        <!-- Table Container -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <!-- Table Header with Total Count -->
            {{-- <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $products->total() }} products
                </div>
            </div> --}}

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Stock
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Added
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-10 w-10 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="h-10 w-10 bg-gray-100 dark:bg-gray-600 flex items-center justify-center rounded-lg">
                                            <svg class="h-6 w-6 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $product->category->name ?? 'No Category' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    Rp {{ number_format($product->price, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 dark:bg-gray-600 rounded-full h-2 mr-2">
                                            @php
                                                $stockPercentage = min(100, ($product->stock / 50) * 100);
                                                $stockColor = $stockPercentage < 20 ? 'bg-red-500' : ($stockPercentage < 50 ? 'bg-yellow-500' : 'bg-green-500');
                                            @endphp
                                            <div class="h-2 rounded-full {{ $stockColor }}" style="width: {{ $stockPercentage }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">{{ $product->stock }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $product->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <flux:dropdown>
                                        <flux:button icon:trailing="chevron-down" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Actions</flux:button>
                                        <flux:menu class="w-40">
                                            <flux:menu.item icon="eye" href="{{ route('products.show', $product->id) }}">View</flux:menu.item>
                                            <flux:menu.item icon="pencil" href="{{ route('products.edit', $product->id) }}">Edit</flux:menu.item>
                                            <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                                            <flux:menu.item 
                                                icon="trash" 
                                                variant="danger" 
                                                onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')"
                                            >
                                                Delete
                                            </flux:menu.item>
                                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
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
                    Showing <span class="font-medium">{{ $products->firstItem() }}</span> to <span class="font-medium">{{ $products->lastItem() }}</span> of <span class="font-medium">{{ $products->total() }}</span> results
                </div>
                <div class="flex space-x-2">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(productId, productName) {
        Swal.fire({
            title: 'Hapus Produk',
            html: `Apakah Kmau Yakin Ingin Menghapus>${productName}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'tidak',
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
                document.getElementById(`delete-form-${productId}`).submit();
            }
        });
    }
    </script>
</x-layouts.app>