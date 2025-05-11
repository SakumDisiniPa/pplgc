<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md space-y-6">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 rounded-full bg-primary-100 dark:bg-gray-800 flex items-center justify-center mb-4">
                    <i class="fas fa-envelope-circle-check text-primary-600 dark:text-primary-400 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Verify Your Email</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Thanks for signing up! Please verify your email address by clicking the link we sent.
                </p>
            </div>

            <!-- Status Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-200">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <!-- Card -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md space-y-6">
                <p class="text-gray-600 dark:text-gray-300 text-center">
                    Didn't receive the email? We'll gladly send you another.
                </p>

                <!-- Resend Form -->
                <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                    @csrf
                    <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i> Resend Verification Email
                    </button>
                </form>

                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300 transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i> Return to Login
                    </button>
                </form>
            </div>

            <!-- Support Message -->
            <div class="text-center text-xs text-gray-500 dark:text-gray-400">
                Need help? <a href="#" class="text-primary-600 hover:text-primary-500 dark:text-primary-400">Contact support</a>
            </div>
        </div>
    </div>
</x-guest-layout>