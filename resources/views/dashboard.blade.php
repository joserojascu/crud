<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
        <h3>Facturación</h3>
        <form action="{{ route('consulta') }}" method="POST">
            @csrf
            <div class="row">
                <div class="column">
                    <label for="id">Cedula:</label>
                    @if(isset($clientes))

                    <input type="text" id="id" name="id" value="{{ $clientes->id ?? '' }}">
                    @else
                    <input type="text" id="id" name="id" value="">
                    @endif
                    <button class="search-btn" type="submit"><span class="fas fa-search"> Buscar</button>
                </div>
            </div>
        </form>
        <form class="formulario" action="{{ route('productos.agregar') }}" method="POST">
            @csrf
            <div class="row">
                <div class="column">
                    <div class="input-group">
                        @if(isset($clientes))
                        <input type="hidden" id="id_cliente" name="id_cliente" value="{{ $clientes->id ?? '' }}">
                        <label for="nombre">Nombre del Cliente:</label>
                        <input type="text" id="nombre" name="nombre" value="{{ $clientes->nombre ?? '' }}">
                    </div>
                </div>
                <div class="column">
                    <div class="input-group">
                        <label for="eps">EPS del Cliente:</label>
                        <input type="text" id="eps" name="eps" value="{{ $clientes->eps ?? '' }}">
                    </div>
                </div>
                <div class="column">
                    <div class="input-group">
                        <label for="fecha">Fecha Actual:</label>
                        <input type="date" id="fecha" readonly name="fecha" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <div class="input-group">
                        <label for="tipo_facturacion">Tipo de Facturación:</label>
                        <select id="tipo_facturacion" name="tipo_facturacion">
                            <option value="evento">Evento</option>
                            <option value="capitacion">Capitación</option>
                        </select>
                    </div>
                </div>
                <div class="column">
                    <div class="input-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" readonly id="usuario" name="usuario" value="{{auth()->user()->name;}}">
                        <input type="hidden" id="id_usuario" name="id_usuario" value="{{auth()->user()->id;}}">
                    </div>
                </div>
                <div class="column">
                    <div class="input-group">
                        <label for="observacion">Observación:</label>
                        <textarea id="observacion" name="observacion"></textarea>
                    </div>
                </div>
            </div>
            @if(!isset($formula) && !isset($id_formula))
            <button type="submit" class="search-btn">Asignar venta</button>
            @endif
        </form>

        <div class="detalle-facturacion">
            <h3>Detalle de facturación</h3>
            <div id="contenido">
                @if(isset($datos))
                <form class="formulario" action="{{ route('factulineas.agregar') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id_cliente" name="id_cliente" value="{{ $clientes->id ?? '' }}">
                    <div class="row">
                        <div class="column">
                            <div class="input-group">
                                <label for="cantidad">Numero de venta:</label>
                                @if(isset($id_formula))
                                <input type="text" readonly name="id_formula" id="id_formula" value="{{ $id_formula ?? '' }}">
                                @else
                                <input type="text" readonly name="id_formula" id="id_formula" value="{{ $formula ->id ?? '' }}">
                                @endif
                            </div>
                        </div>
                        <div class="column">
                            <div class="input-group">
                                <label for="producto">Producto:</label>
                                <select id="id_producto" name="id_producto">
                                    @foreach ($datos as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="column">
                            <div class="input-group">
                                <label for="cantidad">Cantidad:</label>
                                <select id="cantidad" name="cantidad">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="search-btn" type="submit"> </span> Agregar</button>
                </form>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Lote</th>
                            <th>Vencimiento</th>
                            <th>Precio unitario</th>
                            <th>Precio total</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos1 as $item1)
                        <tr>
                            <td>{{ $item1->nombre }}</td>
                            <td>{{ $item1->total_cantidad }}</td>
                            <td>{{ $item1->lote }}</td>
                            <td>{{ $item1->vencimiento }}</td>
                            <td>{{ $item1->precio }}</td>
                            <td>{{number_format($item1->precio * $item1->total_cantidad, 2, '.', ',')}}</td>
                            <td>
                                <form action="{{ route('factulineas.edit', $item1->id) }}" method="GET">
                                    <button class="btn btn-warning btn-sm">
                                        <span class="fas fa-user-edit"></span>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('productos.destroy', ['id' => $item1->id, 'id_formula' => $id_formula, 'id_cliente' => $clientes->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <span class="fas fa-times"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <span class="fas fa-save"></span> Guardar Compra
            </a>
            @endif
            @endif
        </div>
        <br>
    </div>
</body>
</html>