<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class='table-responsive'>
                <table id='example' class='table table-striped table-bordered' style='width:100%'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Amount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($purchases as $row){ ?>
                        <tr>
                            <td>
                                <?php echo $row['idpurchase']; ?>
                            </td>
                            <td>
                                <?php echo $row['productname']; ?>
                            </td>
                            <td>
                                <?php echo date('d-m-Y',strtotime($row['datepurchase'])); ?>
                            </td>
                            <td>
                                <?php echo $row['timepurchase']; ?>
                            </td>
                            <td>
                                <?php echo $row['amount']; ?>
                            </td>
                            <td>
                                $<?php echo number_format($row['total'],2); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
                                <input type="text" class="form-control" id="newproductprice" required/>
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