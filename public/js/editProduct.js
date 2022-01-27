$(document).ready(function(){

    $(document).on('click','.editButton', function(){ 

        let idprod      = $(this).data('idproduct');
        let product     = $(this).data('product');
        let description = $(this).data('description');
        let stock       = $(this).data('stock');
        let price       = $(this).data('price');

        $('#productContent').val(product);
        $('#productDescription').val(description);
        $('#productStock').val(stock);
        $('#productPrice').val(price);

        $(document).on('click','.submitBtn', function(){

            if($('#productContent').val()!='' && $('#productDescription').val()!='' && $('#productStock').val()!='' && $('#productPrice').val()!=''){

                product     = $('#productContent').val();
                description = $('#productDescription').val();
                stock       = $('#productStock').val();
                price       = $('#productPrice').val();

                $.ajax({
                    url: 'editProduct',
                    method: 'POST',
                    data:{ idprod       : idprod,
                           name         : product,
                           description  : description,
                           stock        : stock,
                           price        : price
                        }
                    }).done(function(msg){
                        if(msg != 'ERROR'){
                            swal({
                                title: 'Product modified!',
                                icon: 'success',}).then(() => {window.location.reload();});
                        }
                        else{
                            swal('Something went wrong!', {
                            icon: "warning",});
                        }
                    });
            }

        });

    });
});