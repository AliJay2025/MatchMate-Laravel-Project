@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Team</h1>
        
        <form action="{{ route('teams.update', $team) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Team Name</label>
                <input type="text" name="name" value="{{ $team->name }}" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Short Name</label>
                <input type="text" name="short_name" value="{{ $team->short_name }}" class="w-full px-3 py-2 border rounded-lg" maxlength="10">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Home Ground</label>
                <input type="text" name="home_ground" value="{{ $team->home_ground }}" class="w-full px-3 py-2 border rounded-lg">
            </div>
            
            <div class="flex justify-end gap-3">
                <a href="{{ route('teams.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Cancel</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Update Team</button>
            </div>
        </form>
    </div>
</div>
@endsection