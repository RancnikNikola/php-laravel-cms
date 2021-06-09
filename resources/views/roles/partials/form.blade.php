@csrf
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
        value="{{ old('name')}} @isset($role) {{ $role->name }} @endisset">
    @error('name')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
    @enderror
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
    value="{{ old('slug')}} @isset($role) {{ $role->slug }} @endisset">
    @error('slug')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
    @enderror
</div>

@foreach ($permissions as $permission)
    <div class="checkbox">
        
        <label>
            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $role->hasPermission($permission->name) ? 'checked' : ''}}>
            {{ $permission->name }}
        </label>
       
    </div>
@endforeach

<button type="submit" class="btn btn-primary">Submit</button>