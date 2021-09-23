<!DOCTYPE html>
<html>
<head>
    <title>Ipaymu</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
  
    <div class="container">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <img width="20%" src="https://3.bp.blogspot.com/-8-OzIAEbSCA/XpezSSZw9oI/AAAAAAAASxg/IsOqbHtucWc4OnZEKxEvK3cvp_o_rVfRACLcBGAsYHQ/s1600/Nomor-Call-Center-Customer-Service-iPaymu.jpg" alt="" srcset="">
        </div>
        <form action="{{ route('kariawan.update',$karyawan->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $karyawan->name }}" placeholder="Name" required="">
            </div>
  
            <div class="form-group">
                <label>Pekerjaan:</label>
                <input type="text" name="pekerjaan" class="form-control"  value="{{ $karyawan->pekerjaan }}"  placeholder="Pekerjaan" required="">
            </div>
   
   
            <div class="form-group">
                <button class="btn btn-primary btn-submit">Submit</button>
            </div>
  
        </form>
    </div>
  
</body>

   
</html>