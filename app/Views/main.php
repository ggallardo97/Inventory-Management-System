
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class='table-responsive'>
                <table id='example' class='table table-striped table-bordered' style='width:100%'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($products as $row){ ?>
                        <tr>
                            <td>
                                <?php echo $row['idproduct']; ?>
                            </td>
                            <td>
                                <?php echo $row['productname']; ?>
                            </td>
                            <td>
                                <?php echo $row['description']; ?>
                            </td>
                            <td>
                                $<?php echo number_format($row['price'],2); ?>
                            </td>
                            <td>
                                <?php echo $row['stock']; ?>
                            </td>
                            <td>
                            <button type="button" data-idproduct    = "<?php echo $row['idproduct']; ?>" 
                                                  data-product      = "<?php echo $row['productname']; ?>" 
                                                  data-description  = "<?php echo $row['description']; ?>" 
                                                  data-stock        = "<?php echo $row['stock']; ?>" 
                                                  data-price        = "<?php echo $row['price']; ?>" 
                                                  class="btn btn-primary btn-sm fa fa-edit editButton" 
                                                  data-toggle="modal" data-target="#modalForm"></button>
                            <button type="button" data-idproduct="<?php echo $row['idproduct']; ?>" class="btn btn-danger btn-sm fa fa-trash deleteButton"></button>
                            <button type="button" data-idproduct    ="<?php echo $row['idproduct']; ?>" 
                                                  data-product      = "<?php echo $row['productname']; ?>"
                                                  data-stock        = "<?php echo $row['stock']; ?>" 
                                                  data-price        = "<?php echo $row['price']; ?>"
                                                  data-toggle="modal" data-target="#modalFormBuy"
                                                  class="btn btn-success btn-sm fa fa-shopping-cart buyButton"></button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 <!-- Modal for editting a product-->
 <div class="modal fade" id="modalForm" role="dialog">
            <div class="modal-dialog" width="600">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4>Edit product</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">X</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form role="form" action="" id="editForm" method="POST">
                            <div class="form-group">
                                <label>Product</label>
                                <input type="text" class="form-control" id="productContent" required/>
                                <label>Description</label>
                                <input type="text" class="form-control" id="productDescription" required/>
                                <label>Stock</label>
                                <input type="number" class="form-control" id="productStock" required/>
                                <label>Price</label>
                                <input type="text" class="form-control" id="productPrice" required/>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary submitBtn">EDIT</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for purchase-->
 <div class="modal fade" id="modalFormBuy" role="dialog">
            <div class="modal-dialog" width="600">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4>Buy product</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">X</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form role="form" action="" id="editForm" method="POST">
                            <div class="form-group">
                                <label>Product</label>
                                <input type="text" class="form-control" id="productName"/>
                                <label>Amount</label>
                                <input type="number" min="1" class="form-control" id="productAmount"/>
                                <label>Total</label>
                                <input type="text" class="form-control" id="productTotal"/>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary submitBtnBuy">CONFIRM PURCHASE</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal for add a product-->
 <div class="modal fade" id="modalFormAdd" role="dialog">
            <div class="modal-dialog" width="600">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4>Add product</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">X</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form role="form" action="" id="editForm" method="POST">
                            <div class="form-group">
                                <label>Product</label>
                                <input type="text" class="form-control" id="newproductname" required/>
                                <label>Description</label>
                                <input type="text" class="form-control" id="newproductdescrip" required/>
                                <label>Stock</label>
                                <input type="number" min="1" class="form-control" id="newproductstock" required/>
                                <label>Price</label>
                                <input type="number" step="any" class="form-control" id="newproductprice" required/>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary addButton">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>