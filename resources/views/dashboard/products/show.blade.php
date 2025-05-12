<x-layouts.app :title="$product->name">
    <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">View Product</h1>
                <p class="text-gray-600 dark:text-gray-300">Detailed information about the product</p>
            </div>

            <flux:button icon="arrow-left" variant="subtle" href="{{ route('products.index') }}">
                Back to List
            </flux:button>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 space-y-6">
            <div class="flex items-start space-x-6">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded-xl border border-gray-200 dark:border-gray-600">
                @else
                    <div class="w-48 h-48 bg-gray-100 dark:bg-gray-600 flex items-center justify-center rounded-xl text-gray-500 dark:text-gray-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif

                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $product->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        Category: <strong>{{ $product->category->name ?? 'No Category' }}</strong>
                    </p>
                    <p class="text-gray-600 dark:text-gray-300 mt-1">
                        Price: <strong>Rp {{ number_format($product->price, 2, ',', '.') }}</strong>
                    </p>
                    <p class="text-gray-600 dark:text-gray-300 mt-1">
                        Stock: <strong>{{ $product->stock }}</strong>
                    </p>
                    <p class="text-gray-600 dark:text-gray-300 mt-1">
                        Created At: <strong>{{ $product->created_at->format('d M Y, H:i') }}</strong>
                    </p>
                </div>
            </div>

            @if($product->description)
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Description</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $product->description }}</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
