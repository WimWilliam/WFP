<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    img {
        width: 200px;
        height: 100px;
    }
    div {
        border: 1px solid;
        padding: 10px;
        margin: 10px;
        border-radius: 10px;
    }

</style>
<body>

<div class="container">
  <h2>Average Price</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Type Hotel</th>
        <th>Nama Hotel</th>
        <th>Rata Rata Harga</th>
      </tr>
    </thead>
    <tbody>
        
        @foreach($dataPrice as $r)
        <tr>
            <td>{{$r->name}}</td>
            <td>{{$r->namahotel}}</td>
            <td>{{$r->price}}</td>
        </tr>
        @endforeach



    </tbody>
  </table>
  <br>
</div>
</body>
</html>


