<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/productManage" class="btn btn-outline-primary">Go back</a><br><br>
                <div class="card">
                    <div class="card-body">
                        @if(session('update'))
                        <div class="alert alert-success" role="alert">{{ session('update') }}</div>
                        @endif
                        @if(session('fail'))
                        <div class="alert alert-danger" role="alert">{{ session('fail') }}</div>
                        @endif
                      <form action="{{url('updateProduct/'.$data->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                       <div class="form-group">
                        <input type="text" name="name"  value="{{$data->name}}" class="form-control">
                       </div><br><br>
                       <div class="form-group">
                        <input type="text" name="amount"   value="{{$data->amount}}" class="form-control">
                       </div><br><br>
                       <div class="form-group">
                        <input type="text" name="description"  value="{{$data->description}}" class="form-control">
                       </div><br><br>
                       
                       <div class="form-group" class="form-control">
                        <button type="submit" class="btn btn-success">Update</button>
                       </div>
                       
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>