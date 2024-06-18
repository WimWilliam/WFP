<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table, th, td 
        {
            border: 1px solid black;
            border-collapse: collapse;
        }
        h3 
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        
        <tr>
            <!-- Baris 1 kolom 1 -->
            <th><h3>GAMBAR</h3></th>
            <!-- Baris 1 kolom 2 -->
            <th><h3>DESKRIPSI</h3></th>
        </tr>

            <!-- foreach($variabel penampung array dalam return di halaman web.php as $variabel bebas) -->
            @foreach($cinema as $sin)
                <tr>
                     <!-- Baris 2 kolom 1 -->
                    <td><img src="{{@$sin['gambar']}}"></td>
                     <!-- Baris 2 kolom 2 -->
                    <td>{{@$sin['deskripsi']}}</td>
                </tr>
            @endforeach
  
    </table>
</body>
</html>