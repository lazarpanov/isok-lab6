<h1>Edit Blog</h1>

<form method="POST" action="{{ route('blogs.update', $blog) }}">
    @csrf
    @method('PUT')

    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}">
        @error('invoice_number')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $category->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Update Blog</button>
</form>

<a href="{{ route('blogs.index') }}">Back to Blogs</a>
