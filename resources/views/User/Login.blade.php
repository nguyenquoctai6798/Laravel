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
        <div class='container'>
            <?php if(Session::has('error')){
             $error = Session::get('error');?>
            <div class="alert alert-danger">
                <?php echo $error ?>
                <br />
            </div>
            <?php }?>

            <?php if(Session::has('success')){
             $success = Session::get('success');?>
            <div class="alert alert-success">
                <?php echo $success ?>
                <br />
            </div>
            <?php }?>

            <?php if(Session::has('errors')){
            $errors =  Session::get('errors');
            foreach ($errors->all() as $key => $error) {
        ?>
            <div class="alert alert-danger">
                <?php echo $error ?>
                <br />
            </div>
            <?php }} ?>
            <h1>Đăng nhập</h1>
            <form action="/test/server.php/Login" method='post'>
                @csrf
                Tài khoản: <input type="text" class="form-control" name="email" id=""  aria-describedby="helpId"  ?>
                Mật khẩu: <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" ?>
                <br />
                <button class='btn btn-success' type='submit'>Đăng nhập</button>
                <button class='btn btn-warning'><a href="/test/server.php/SignUp">Đăng ký</a></button>
            </form>
               

        </div>
</body>

</html>