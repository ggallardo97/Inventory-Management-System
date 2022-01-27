$(document).ready(function(){

    $(document).on('click','.addButton', function(){ 

        if($('#newproductname').val()!='' && $('#newproductdescrip').val()!='' && $('#newproductstock').val()!='' && $('#newproductprice').val()!=''){

            product     = $('#newproductname').val();
            description = $('#newproductdescrip').val();
            stock       = $('#newproductstock').val();
            price       = $('#newproductprice').val();

            $.ajax({
                url: 'addProduct',
                method: 'POST',
                data:{ 
                    name         : product,
                    description  : description,
                    stock        : stock,
                    price        : price
                }}).done(function(msg){
                    if(msg != 'ERROR'){
                        swal({
                            title: 'Product added successfully!',
                            icon: 'success',}).then(() => {window.location.reload();});

                    }else{
                        swal('Something went wrong!', {
                        icon: "warning",});
                    }
                });
        }
    });
});