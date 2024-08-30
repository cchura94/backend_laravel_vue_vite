<style>
    .container{
        width: 80%;
        margin: 0 auto;
    }
    .header{
        text-align: center;
        margin: 0 auto;
    }
    .info {
        margin-bottom: 20px;
    }
    .info p {
        margin: 5px 0;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    .table th {
        background-color: #f2f2f2;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Recibo # {{ $pedido->id }}</h1>
    </div>
    
    <div class="info">
        <p><strong>Fecha Pedido:</strong> {{ $pedido->fecha_pedido }}</p>
        <p><strong>ESTADO:</strong> {{ $pedido->estado }}</p>
        <p><strong>CLIENTE:</strong> {{ $pedido->cliente->nombre_completo }} - {{ $pedido->cliente->ci_nit }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>COD</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->pivot->cantidad }}</td>
                <td>{{ number_format($producto->precio * $producto->pivot->cantidad, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>