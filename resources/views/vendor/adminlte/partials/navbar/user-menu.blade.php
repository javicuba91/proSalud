@php
    $user = Auth::user();
@endphp

<li class="nav-item">
    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ $user->name }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>
