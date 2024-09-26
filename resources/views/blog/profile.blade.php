@extends('layouts.layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')
    <div class="profile-container">
        <div class="profile-details">
            <h4> Username: {{ $user->username }}</h4>
        </div>
        <div class="profile-details">
            <h4> Email: {{ $user->email }}</h4>
        </div>
        <form action="{{ route('profile.edit') }}" method="GET">
            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>

    <h2 style="text-align: center;">Posts</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->getExcerpt(20) }}</td>
                    @if (isset($post->image))
                        <td>
                            <img src="{{ Storage::url($post->image) }}" alt="image">
                        </td>
                    @else
                        <td>
                            <p>No image</p>
                        </td>
                    @endif
                    <td>
                        <form action="{{ route('post.delete', $post->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">Delete</button>
                        </form>
                        <form action="{{ route('post.edit', $post->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn">Update</button>
                        </form>

                        <form action="{{ route('post.show', $post->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn">View</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>
    <!-- Pagination Links -->
    <x-pagination :paginator="$posts" />

    </div>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this post?");
        }
    </script>
@endsection
