<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4">View Voter</h2>

    <dl class="grid grid-cols-1 gap-4">
        <div>
            <dt class="text-sm font-medium text-gray-500">Name</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Email</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Phone</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->phone ?? '-' }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Is Admin</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->is_admin ? 'Yes' : 'No' }}</dd>
        </div>
    </dl>

    <div class="mt-4">
        <a href="{{ route('voters.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Back</a>
        <a href="{{ route('voters.edit', $user) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Edit</a>
    </div>
</div>
