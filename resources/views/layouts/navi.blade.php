@foreach ($navs as $nav)
<li class="nav-item">
    <a class="nav-link" href="{{ route('pages.show', ['page' => $nav->page->id ])}}">{{ $nav->page->title }}</a>
</li>
@endforeach
