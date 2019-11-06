<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/HomeCss.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c5048271fb.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class='row'>
     <div class='col-sm-8'></div>
     <div class='col-sm-4'><strong><i> <?php echo  $name?></i></strong>
     <a href="/test/server.php/Logout"><i class="fas fa-sign-out-alt"></i></a>
     </div>
    </div>
    
    <h1> Show Products <a href='/test/server.php/CreateProduct'><i class="fas fa-plus-circle"></i> </a></h1>

    <div class='container'>
        <?php if(Session::has('success')){
     $success = Session::get('success');?>
        <div class="alert alert-success">
            <?php echo $success ?>
            <br />
        </div>
        <?php }?>
        <div class='row'>
            <?php 
        foreach ($lsProduct as $key => $value) { ?>
            <div class="card col-sm-3">
                <a href = "/test/server.php/ShowProductDetail/<?php echo $value->Id ?>" >
                    <img class="card-img-top" src="public/Images/<?php echo $value->Img?>" alt="Card image cap">
                    <div class="card-body">
                        <div class="title" style="font-size:22px; font-weight ='bold'"><?php echo $value->Name ?></div>
                        <div class="title"><i><?php echo 'Giá: ' . $value->Price ?></i></div>
                        <div class='row'>
                            <div class='col-sm-3'></div>
                            <button class='btn btn-success'><a style='color:white'
                                    href="/test/server.php/EditProduct/<?php echo $value->Id ?>">Sửa</a></button>
                            <div class='col-sm-1'></div>
                            <button class='btn btn-danger'><a style='color:white'
                                    href="/test/server.php/DeleteProduct/<?php echo $value->Id ?>">Xóa</a></button>
                        </div>
                </a>
            </div>
        </div>
        <?php }
        ?>
    </div>
    </div>
</body>

</html>