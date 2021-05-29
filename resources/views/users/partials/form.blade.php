@csrf
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
        value="{{ old('name')}} @isset($user) {{ $user->name }} @endisset">
    @error('name')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
    @enderror
</div>

<div class="mb-3">
    <label for="surname" class="form-label">Surname</label>
    <input type="text" name="surname" id="surname" class="form-control @error('surname') is-invalid @enderror"
    value="{{ old('surname')}} @isset($user) {{ $user->surname }} @endisset">
    @error('surname')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email')}} @isset($user) {{ $user->email }} @endisset">
    @error('email')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
    @error('password')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
    @enderror
</div>

{{-- ROLES OPTIONS --}}

<div class="mb-3">
    <label class="form-label" for="role">{{ __('Role') }}</label>
        <select type="text" name="role" id="role" class="form-control" value="{{ old('role') }}" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name ) ? 'selected' : ''}}>{{ $role->name }}</option>
                @endforeach
        </select>

        @if ($errors->has('role'))
            <span class="help-block">
                <strong>{{ $errors->first('role') }}</strong>
            </span>
        @endif
</div>



<button type="submit" class="btn btn-primary">Submit</button>