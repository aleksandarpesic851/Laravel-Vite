<x-app-layout>
    <div>
        <a class="underline text-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register.boxer') }}">
            {{ __('Register as Boxer') }}
        </a>
    </div>

    <div class="mt-4">
        <a class="underline text-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register.promoter') }}">
            {{ __('Register as Promoter') }}
        </a>
    </div>

    <div class="mt-4">
        <a class="underline text-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register.match_maker') }}">
            {{ __('Register as Match Maker') }}
        </a>
    </div>

    <div class="mt-4">    
        <a class="underline text-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register.manager') }}">
            {{ __('Register as Manager') }}
        </a>
    </div>
</x-app-layout>
