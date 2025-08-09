<div x-show="sidebarOpen" class="fixed inset-0 flex z-40 lg:hidden" x-cloak>
    <div @click="sidebarOpen = false" class="fixed inset-0 bg-black opacity-25"></div>
    <div class="relative flex-1 flex flex-col w-64 max-w-xs bg-white dark:bg-slate-900">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <span class="sr-only">Close sidebar</span>
                <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-4">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ $settings->logo ?? asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                <span class="ml-3 text-lg font-bold text-slate-800 dark:text-slate-200">{{ $settings->name ?? config('app.name') }}</span>
            </a>
        </div>
        <nav class="mt-5 flex-1 px-2 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-slate-200 dark:bg-slate-800' : '' }} text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('candidates.index') }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('candidates.*') ? 'bg-slate-200 dark:bg-slate-800' : '' }} text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Candidates
            </a>
            <a href="{{ route('positions.index') }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('positions.*') ? 'bg-slate-200 dark:bg-slate-800' : '' }} text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                </svg>
                Positions
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('categories.*') ? 'bg-slate-200 dark:bg-slate-800' : '' }} text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Categories
            </a>
            <a href="{{ route('voters.index') }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('voters.*') ? 'bg-slate-200 dark:bg-slate-800' : '' }} text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" />
                </svg>
                Voters
            </a>
            <div class="border-t my-2 dark:border-slate-800"></div>
            <a href="{{ route('vote') }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('vote*') ? 'bg-slate-200 dark:bg-slate-800' : '' }} text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Vote
            </a>
            <a href="{{ route('results') }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('results*') ? 'bg-slate-200 dark:bg-slate-800' : '' }} text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Results
            </a>
            <div class="border-t my-2 dark:border-slate-800"></div>
            <a href="{{ route('settings.index') }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('settings.*') ? 'bg-slate-200 dark:bg-slate-800' : '' }} text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800">
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
            </a>
        </nav>
    </div>
</div>
