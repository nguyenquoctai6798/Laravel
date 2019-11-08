<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      
</head>

<body>
    <div class="container">
    <h1 style='text-align:center'>Show Product Detail</h1>
    <div class='row'>
    <div class='col-sm-4'>
        <img class="card-img-top" src = "public/Images/<?php echo $product[0]->Img?>" alt="Card image cap">
    </div>
    <div class='col-sm-8'>
    Tên xe: <div class="form-group">
                <input type="text" class="form-control" name="Name" id="" aria-describedby="helpId" disabled
                    value="<?php echo $product[0]->Name ?>" ?>
            </div>
            Giá tiền:<div class="form-group">
                <input type="text" class="form-control" name="Price" id="" aria-describedby="helpId" disabled
                    value="<?php echo $product[0]->Price ?> " ?>
            </div>

            Mô tả:<div class="form-group">
                <input type="text" class="form-control" name="Description" id="" aria-describedby="helpId" disabled
                    placehoder = 'Nhập mô tả'  value = "<?php echo $product[0]->Description ?>" ?>
            </div>

            <a href = '/test/server.php'><button type='submit' class='btn btn-success'>Back</button></a>
    </div>

    </div>
   
    

    </div>
</body>

</html>