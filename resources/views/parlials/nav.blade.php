@auth
<form action="/logout" method="post">
@csrf
<a href="#" onclick="this.closest('form').submit()">Salir</a>
</form>
@else
<a href="/login">login</a>
@endauth