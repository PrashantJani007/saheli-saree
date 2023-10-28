<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
    
    <div class="container mt-5 mr-10">
        <h1>Add Product</h1><br>
        <div class="row">
            <form method="post" enctype="multipart/form-data" id="my-form">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Please enter product name" class="form-control">
                </div>
                <div class="form-group">
                    <input type="number" name="price" id="price" placeholder="Please enter product price" class="form-control">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="5" name="description" cols="5" placeholder="Product description"></textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="image[]" multiple>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="add" value="Add Product">
                </div>
            </form>
        </div>
    </div>
    
    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js" integrity="sha512-TiQST7x/0aMjgVTcep29gi+q5Lk5gVTUPE9XgN0g96rwtjEjLpod4mlBRKWHeBcvGBAEvJBmfDqh2hfMMmg+5A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#my-form").validate({
            rules:{
                name:{
                    required:true
                },
                price:{
                    required:true
                },
                description:{
                    required:true
                },
                'image[]':{
                    required:true
                }
            },
            messages:{
                name:{
                    required:"Please enter product name/title"
                },
                price:{
                    required:'Please enter product price'
                },
                description:{
                    required:'Please enter product description'
                },
                'image[]':{
                    required:'Please upload product image'
                }
            },
            submitHandler:function(form,e){
                e.preventDefault();
                var formData = new FormData(form);
                console.log(...formData);
                $.ajax({
                    url:"/add-product",
                    type:"POST",
                    cache:false,
                    processData:false,
                    contentType:false,
                    data:formData,
                    success:function(result){
                        if(result.status == true){
                            toastr.success('Product added succesfully');
                        }else{
                            toastr.error('Something went wrong 1');
                        } 
                    },
                    error:function(error){
                        toastr.error('Something went wrong 2');
                    }
                })
            }
        })
    </script>
</body>
</html>