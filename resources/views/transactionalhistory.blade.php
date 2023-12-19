<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Mystore</title>
</head>
<body>
    <div class="container-fluid bg-dark text-light text-center">
        <h4>Store Management System</h4>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 ">
                <h5 text-center>Menus</h5>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/productlist">Products List</a></li>
                        <li><a href="/dashboard">Dashboard</a></li>
                        <li><a href="/addproduct">Add Product</a></li>
                        <li><a href="/transactionalhistory">Transactional History</a></li>
                    </ul>
            </div>
            <div class="col-9">
              
                <section>
                    <div class="card">
                        <div class="card-header align-middle text-success"><h6>Transactional History</h6></div>
                        <div class="card-body">
                            
                            <table  class="table table-striped table-sm" cellspacing="0"
                            width="100%">
                                <thead>
                                    <tr class="align-middle border border-primary text-bg-secondary" style="font-size: 12px;font-weight:200">
                                    <th scope="col" class="align-middle border border-primary text-center">Sl ID</th>
                                    <th scope="col" class="align-middle border border-primary text-center">Product Name</th>
                                    <th scope="col" class="align-middle border border-primary text-center">Product Description</th>
                                    <th scope="col"class="align-middle border border-primary text-center">Unit Price</th>
                                    <th scope="col"class="align-middle border border-primary text-center">Quantity</th>
                                    <th scope="col"class="align-middle border border-primary text-center">Total Amount</th>                                  
                                    <th scope="col"class="align-middle border border-primary text-center">SaleDate</th>                                  

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productsalehistory as $result)

                                        <tr class="po-body border border-primary">
                                            <th class="align-middle border border-primary" scope="row">{{  $result->id }}</th>
                                            <td class="align-middle border border-primary">{{  $result->name }}</td>
                                            <td class="align-middle border border-primary">{{  $result->description }}</td>
                                            <td class="align-middle border border-primary">{{  $result->price }}</td>
                                            <td class="align-middle border border-primary">{{  $result->quantity }}</td>
                                            <td class="align-middle border border-primary">{{  $result->price*$result->quantity }}</td>
                                            <td class="align-middle border border-primary">{{  $result->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $productsalehistory->links() }}
                        </div>
                    </div>
                </section>


            </div>
        </div>
    </div>
</body>
</html>