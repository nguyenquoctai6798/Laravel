<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
     <h1>Đăng ký</h1>
     <?php if(Session::has('errors')){
            $errors =  Session::get('errors');
            foreach ($errors->all() as $key => $error) {
        ?>
        <div class="alert alert-danger">
            <?php echo $error ?>
            <br/>
        </div>
        <?php }} ?>
        <form action="/test/server.php/SignUp/" method='post'>
        @csrf
            Tên: <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" ?>
            Tuổi: <input type="text" class="form-control" name="age" id="" aria-describedby="helpId" ?>
            Email: <input type="text" class="form-control" name="email" id="" aria-describedby="helpId" ?>
            Password: <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" ?>
            <br />
            <button class='btn btn-success' type='submit'>Đăng ký</button>
        </form>

    </div>
</body>

</html>