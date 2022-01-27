$(document).ready(function(){

    $(document).on('click','.deleteButton', function(){ 

        let deleteIdProduct = $(this).data('idproduct');

        swal({
            title: "Are you sure?",
            text: "This product will be deleted from the data base!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((willDelete) => {
                if(willDelete){
                    $.ajax({
                        url: 'deleteProduct',
                        method: 'POST',
                        data:{
                            idproduct: deleteIdProduct
                        }
                    }).done(function(msg){
                        if(msg != 'ERROR'){
                            swal({
                                title: 'Product deleted!',
                                icon: 'success',}).then(() => {window.location.href = 'main'});
                        }else{
                            swal('Something went wrong!',{
                            icon: "warning",});
                        }
                    });
                }
            });
    });
});