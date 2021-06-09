@if(Request::url() !== 'http://127.0.0.1:8000/home')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pages.index') }}">Pages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('navs.index') }}">Navigation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
          </li>
      </ul>
    </div>
  </nav>
@endif




    
