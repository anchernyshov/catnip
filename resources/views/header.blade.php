<div>
    <span>Hello, {{ Auth::user()->name }} ({{ Auth::user()->role->name }})</span>
    <a href='/logout'>Log out</a>
</div>