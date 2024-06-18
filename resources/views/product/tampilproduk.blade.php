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
          border: 1px solid black;
          padding: 10px;
          margin: 10px;
          border-radius: 10px;
      }

  </style>
  <body>

  <div class="container">
    <h2>Products</h2>
    <table class="table">
      <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Photo Products</th>
        </tr>
      </thead>
      <tbody>
          
            @foreach($data as $rProduct)
                <tr>
                    <td>{{$rProduct->name}}</td>
                    <td>{{$rProduct->price}}</td>
                        
                    

                <td>
                  <input type="hidden" name="product_name" value="{{$rProduct->id}}">
                  <a class="btn btn-info"  href="#detail_{{$rProduct->id}}" data-toggle="modal">{{ $rProduct->name }}</a>
                  
                  <a href="{{ url('products/uploadPhoto/'.$rProduct->id) }}">
                  <button class='btn btn-xs btn-default'>upload</button></a>


              
                </td>



                </tr>
            @endforeach


      </tbody>
    </table>
    <br>
  </div>
  </body>
  </html>



