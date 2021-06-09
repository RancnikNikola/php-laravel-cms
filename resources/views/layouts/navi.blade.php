@foreach ($navis as $navi)
<li class="nav-item">
    <a class="nav-link" href="{{ route('pages.show', ['page' => $navi->page->id ])}}">{{ $navi->page->title }}</a>
</li>
@endforeach
