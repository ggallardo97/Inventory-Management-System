$(document).ready(function(){

    $(document).on('click','.buyButton', function(){ 

        let idprod      = $(this).data('idproduct');
        let product     = $(this).data('product');
        let stock       = $(this).data('stock');
        let price       = $(this).data('price');
        let amount;

        $('#productName').val(product);
        $('#productName').prop('disabled',true);
        $('#productAmount').val(1);
        $('#productAmount').prop('max',stock);
        $('#productTotal').val(price);
        $('#productTotal').prop('disabled',true);

        $('#productAmount').keyup(function(){

            if($(this).val() != ''){

                amount = $('#productAmount').val();

                $('#productTotal').val(amount*price);
            }
            
        });
        
        $(document).on('click','.submitBtnBuy', function(){

            if($('#productAmount').val()!=''){

                amount   = $('#productAmount').val();
                total    = $('#productTotal').val();

                $.ajax({
                    url: 'buyProduct',
                    method: 'POST',
                    data:{ idprod      : idprod,
                           amount      : amount
                        }
                    }).done(function(msg){
                        if(msg != 'ERROR'){
                            swal({
                                title: 'Purchase made successfully!',
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