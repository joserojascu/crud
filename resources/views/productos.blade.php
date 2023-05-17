<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
    <title>Panel lateral</title>
</head>

<body>
    <div id="panel-lateral">
        <img src="{{asset('1077114.png') }}" alt="Imagen del usuario">
        @include('parlials.nav')
        <br>
        <a href="#">Módulo de facturación</a>
    </div>
    <div id="contenido">
        <br>
        <br>
        <form class="formulario" action="{{ route('factulineas.update', $facturaV->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div>
                <label for="cantidad">Numero de venta :</label>
                <input type="text" readonly name="id_formula" id="id_formula" value="{{ $facturaV ->id_formula ?? '' }}">
            </div>
            <div>
                <label for="producto">Producto:</label>
                <select id="id_producto" name="id_producto">
                    @foreach ($datos as $item)
                    <option value="{{ $item->id }}" @if ($item->id == $facturaV->id_producto) selected @endif>{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="cantidad">Cantidad:</label>
                <select id="cantidad" name="cantidad">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <br>
            <button class="btn btn-warning">
                <span class="fas fa-edit"></span> Actualizar
            </button>
        </form>
        <br>
    </div>
</body>
</html>