<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Site Settings</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Site Name</label>
                <input type="text" wire:model.defer="name" class="mt-1 block w-full">
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tenure</label>
                <input type="text" wire:model.defer="tenure" class="mt-1 block w-full">
                @error('tenure') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model.defer="email" class="mt-1 block w-full">
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" wire:model.defer="phone" class="mt-1 block w-full">
                @error('phone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Website</label>
                <input type="text" wire:model.defer="website" class="mt-1 block w-full">
                @error('website') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" wire:model.defer="address" class="mt-1 block w-full">
                @error('address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tagline</label>
                <input type="text" wire:model.defer="tagline" class="mt-1 block w-full">
                @error('tagline') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">ID Name</label>
                <input type="text" wire:model.defer="id_name" class="mt-1 block w-full">
                @error('id_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model.defer="description" rows="4" class="mt-1 block w-full"></textarea>
            @error('description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Branding Section -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">🎨 Branding & Appearance</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" wire:model="logo" class="mt-1 block w-full">
                    @error('logo') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Favicon</label>
                    <input type="file" wire:model="favicon" class="mt-1 block w-full">
                    @error('favicon') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Election Banner</label>
                    <input type="file" wire:model="election_banner" class="mt-1 block w-full">
                    <p class="text-xs text-gray-500 mt-1">Displayed on voting pages</p>
                    @error('election_banner') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Primary Color</label>
                    <div class="flex gap-2">
                        <input type="color" wire:model.defer="primary_color" class="h-10 w-20 border rounded">
                        <input type="text" wire:model.defer="primary_color" placeholder="#3B82F6" class="flex-1 mt-1 block w-full">
                    </div>
                    @error('primary_color') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Secondary Color</label>
                    <div class="flex gap-2">
                        <input type="color" wire:model.defer="secondary_color" class="h-10 w-20 border rounded">
                        <input type="text" wire:model.defer="secondary_color" placeholder="#10B981" class="flex-1 mt-1 block w-full">
                    </div>
                    @error('secondary_color') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Accent Color</label>
                    <div class="flex gap-2">
                        <input type="color" wire:model.defer="accent_color" class="h-10 w-20 border rounded">
                        <input type="text" wire:model.defer="accent_color" placeholder="#F59E0B" class="flex-1 mt-1 block w-full">
                    </div>
                    @error('accent_color') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Custom CSS (Advanced)</label>
                <textarea wire:model.defer="custom_css" rows="4" placeholder=".custom-class { color: red; }" class="mt-1 block w-full font-mono text-sm"></textarea>
                <p class="text-xs text-gray-500 mt-1">Add custom CSS to override default styles</p>
                @error('custom_css') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Election Start</label>
                <input type="datetime-local" wire:model.defer="election_start" class="mt-1 block w-full">
                @error('election_start') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Election End</label>
                <input type="datetime-local" wire:model.defer="election_end" class="mt-1 block w-full">
                @error('election_end') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Due Deadline</label>
                <input type="date" wire:model.defer="due_deadline" class="mt-1 block w-full">
                @error('due_deadline') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Due Amount</label>
                <input type="number" wire:model.defer="due_amount" step="0.01" class="mt-1 block w-full">
                @error('due_amount') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="space-y-2 mb-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model="is_election_time" class="mr-2">
                <span class="text-sm">Is Election Time</span>
            </label>

            <label class="flex items-center">
                <input type="checkbox" wire:model="is_registration_open" class="mr-2">
                <span class="text-sm">Is Registration Open</span>
            </label>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Save Settings</button>
            <a href="{{ route('dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Cancel</a>
        </div>
    </form>
</div>
