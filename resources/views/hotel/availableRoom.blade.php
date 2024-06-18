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
        text-align: center;
        border: 1px solid black;
        padding: 10px;
        margin: 10px;
        border-radius: 10px;
    }

</style>
<body>

<div class="container">
  <h2>Total availale hotels room</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>Foto</th>
        <th>Room</th>
      </tr>
    </thead>
    <tbody>
        
        @foreach($data as $r)
        <tr>
            <td>{{$r->hotel}}</td>
            <td>{{$r->address}}</td>
            <td>{{$r->city}}</td>
            <td><img src="{{asset('image/'.$r->image)}}" /></td>

            <td>
              @foreach($r->products as $p) 
              - {{$p->name}} ({{$p->price}}) <br>
              @endforeach
            </td>

            <td>{{$r->rooms}}</td>
        </tr>
        @endforeach



    </tbody>
  </table>
  <br>
</div>
</body>
</html>


