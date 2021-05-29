@csrf

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ $page->title }}">
</div>


<div class="form-group">
    <label for="url">URL</label>
    <input type="text" name="url" id="url" class="form-control" value="{{ $page->url }}">
</div>


<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="content">{{ $page->content }}</textarea>
</div>


<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
</div>