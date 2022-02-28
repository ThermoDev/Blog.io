@if (session('msg'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
    {{ session('msg') }}
</div>
@endif
@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
    role="alert">
    {{ session('success') }}
</div>
@endif