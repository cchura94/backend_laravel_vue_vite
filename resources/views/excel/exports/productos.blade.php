<table>
    <thead>
    <tr>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th colspan="2" style="background-color: #00f;color:#fff">SUBTOTAL</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $prod)
        <tr>
            <td>{{ $prod->nombre }}</td>
            <td>{{ $prod->precio }}</td>
            <td colspan="2" style="color: blue;">{{$prod->precio * $prod->cantidad}}</td>
        </tr>
    @endforeach
    </tbody>
</table>