<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>User Login</title>
</head>

<body class="bg-gray-100 p-8">
    <nav class="bg-indigo-500 text-white p-4">
        <div class="container mx-auto flex justify-start items-center">
            <a href="{{ route('createCategory') }}" class="text-lg font-semibold hover:text-indigo-300 mr-4">Add Category</a>
            <a href="{{ route('showAddProductPage') }}" class="text-lg font-semibold hover:text-indigo-300">Add Product</a>
        </div>
    </nav>
    <div class="flex justify-center">

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @foreach ($products as $product)
            <div class="max-w-lg mx-auto mb-4">
                <div class="bg-white border rounded-lg overflow-hidden shadow-md">
                    <div class="relative overflow-hidden pb-60">
                        <img src="{{ asset('storage/' . $product['main_img']) }}" alt="{{ $product['name'] }}"
                            class="absolute h-full w-full object-cover">
                    </div>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $product['name'] }}</h2>
                        <p class="text-sm text-gray-600">{{ $product['description'] }}</p>
                        <div class="mt-2 text-lg text-indigo-600">${{ $product['price'] }}</div>
                        <div class="mt-4">
                            <div class="text-sm text-gray-600">Category: {{ $product['category_name'] }}</div>
                            <div class="text-sm text-gray-600">Category Description:
                                {{ $product['category_description'] }}</div>
                        </div>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('editProduct', ['id' => $product['id']]) }}"
                                class="text-indigo-600 hover:underline hover:text-indigo-800">Edit</a>
                            <a href="{{ route('deleteProduct', ['id' => $product['id']]) }}"
                                class="text-red-600 hover:underline hover:text-red-800">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    </div>
</body>

</html>
