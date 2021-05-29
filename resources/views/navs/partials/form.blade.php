@csrf

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ $nav->name }}">
</div>

<div class="form-group">
    <label for="page_id">Page ID</label>
    <select name="page_id" id="page_id" class="form-control">
        <option value="" disabled>Select Page to Relate to</option>
            @foreach ($pages as $page)
                <option value="{{ $page->id }}">{{ $page->title }}</option>
            @endforeach
    </select>
</div>


<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
</div>