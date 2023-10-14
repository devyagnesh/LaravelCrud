<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>User Registration</title>
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-4">User Registration</h2>
        <form action="{{ route('Signup') }}" enctype="multipart/form-data" method="POST">
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
                <label for="email" class="block text-gray-600">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-600">Phone No</label>
                <input type="tel" id="phone" name="phone"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-600">Address</label>
                <textarea id="address" name="address"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required></textarea>
            </div>

            <div class="mb-4">
                <label for="profilePic" class="block text-gray-600">Profile Pic (JPEG, JPG, PNG validation)</label>
                <input type="file" id="profilePic" name="profilePic" accept=".jpeg, .jpg, .png"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-600">Hobby</label>
                <div class="grid grid-cols-2 gap-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="hobby[]" value="reading" class="mr-2">
                        Reading
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="hobby[]" value="gaming" class="mr-2">
                        Gaming
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="hobby[]" value="sports" class="mr-2">
                        Sports
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-gray-600">Gender</label>
                <select id="gender" name="gender"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="dob" class="block text-gray-600">Date of Birth (18+ validation)</label>
                <input type="date" id="dob" name="dob"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-600">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label for="confirmPassword" class="block text-gray-600">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600 transition duration-300">Register</button>
        </form>
    </div>
</body>

</html>
