<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Create Product</h1>
        <?php if(Session::has('error')){
            $error = Session::get('error');?>
           <div class="alert alert-danger">
               <?php echo $error ?>
               <br />
           </div>
           <?php }?>

        <?php if(Session::has('errors')){
            $errors =  Session::get('errors');
            foreach ($errors->all() as $key => $error) {
        ?>
        <div class="alert alert-danger">
            <?php echo $error ?>
            <br/>
        </div>
        <?php }} ?>
        <form action="/test/server.php/CreateProduct" method='POST' enctype="multipart/form-data">
            @csrf
            Tên xe: <div class="form-group">
                <input type="text" class="form-control" name="Name" id="" aria-describedby="helpId"
                   placehoder = 'Nhập tên' value="{{ old('Name') }}"?>
            </div>
            Giá tiền:<div class="form-group">
                <input type="text" class="form-control" name="Price" id="" aria-describedby="helpId"
                    placehoder = 'Nhập giá' value="{{ old('Price') }}" ?>
            </div>
            Img: <input type = 'file' name = 'myfile' >
            <br/><br/>
            Mô tả:<div class="form-group">
                <input type="text" class="form-control" name="Description" id="" aria-describedby="helpId"
                    placehoder = 'Nhập mô tả' value="{{ old('Description') }}"?>
            </div>
            <button type='submit' class='btn btn-success'>Submit</button>
        </form>
    </div>
</body>

</html>