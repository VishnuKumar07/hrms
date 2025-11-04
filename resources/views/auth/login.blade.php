<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body style="background-color: rgb(243, 244, 246);">

    <div class="flex items-center justify-center min-h-screen px-4">

        <div class="grid w-full max-w-4xl overflow-hidden bg-white shadow-2xl rounded-2xl md:grid-cols-2 fade-in">

            <div class="relative hidden bg-center bg-cover md:block"
                style="background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80');">
                <div class="absolute inset-0 bg-green-700 opacity-70"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white">
                    <h2 class="mb-4 text-3xl font-bold tracking-wide">Welcome to HRMS</h2>
                    <p class="px-6 text-sm">Manage your employees, attendance, leaves, and more — from one place.</p>
                </div>
            </div>

            <div class="p-10 bg-white">

                <h2 class="mb-6 text-3xl font-bold text-green-700">Login</h2>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <label class="block mb-2 font-semibold text-gray-700">Email <span
                            class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full px-4 py-2 border rounded-lg outline-none focus:ring-2 focus:ring-green-600">

                    <label class="block mt-4 mb-2 font-semibold text-gray-700">Password <span
                            class="text-danger">*</span></label>

                    <div class="relative">
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-2 border rounded-lg outline-none focus:ring-2 focus:ring-green-600">

                        <i class="absolute text-xl text-green-700 cursor-pointer bi bi-eye-fill right-3 top-2"
                            id="togglePassword"></i>
                    </div>

                    @error('email')
                        <p class="mt-3 text-sm font-bold text-center text-red-600">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="w-full py-3 mt-6 text-lg font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 hover:scale-[1.02] transition-all">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $("#togglePassword").click(function() {
            let input = $("#password");
            let type = input.attr("type") == "password" ? "text" : "password";
            input.attr("type", type);

            $(this).toggleClass("bi-eye-fill bi-eye-slash-fill");
        });
    </script>

</body>

</html>
