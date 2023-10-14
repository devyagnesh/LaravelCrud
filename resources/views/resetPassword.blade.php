<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>Password Reset</title>
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Password Reset</h2>
        <form action="{{ route('reset') }}" method="POST">
            @csrf
            @if (Session('error'))
                <div class="mb-4 text-red-500">
                    {{ Session('error') }}
                </div>
            @elseif ($errors->any())
                <div class="mb-4 text-red-500">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="mb-4">
                <label for="current_password" class="block text-gray-600">Current Password</label>
                <input type="password" id="current_password" name="current_password"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>
            <div class="mb-4">
                <label for="new_password" class="block text-gray-600">New Password</label>
                <input type="password" id="new_password" name="new_password"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>
            <div class="mb-4">
                <label for="confirm_new_password" class="block text-gray-600">Confirm New Password</label>
                <input type="password" id="confirm_new_password" name="confirm_new_password"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>
            <button type="submit"
                class="w-full bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600 transition duration-300">Reset Password</button>
        </form>
    </div>
</body>

</html>
