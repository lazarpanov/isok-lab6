<h1>Blog Details</h1>

<div>
    <strong>Title:</strong> {{ $blog->title }}
</div>

<div>
    <strong>Category:</strong>
    <a href="{{ route('categories.show', $blog->category->id) }}">
        {{ $blog->category->name }}
    </a>
</div>

<div>
    <strong>Slug:</strong> {{ $blog->slug }}
</div>

<div>
    <strong>Description:</strong> {{ $blog->description }}
</div>

<a href="{{ route('blogs.index') }}">Back to Blogs</a>
