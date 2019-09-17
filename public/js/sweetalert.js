(function(){


    $(document).on('submit', 'form.soft-delete-admin-form', function(){

        var current_form = $(this);


        swal({   title: "Are you sure?",
                text: "Are you sure you want to delete this!",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Yes, Delete it!",
                closeOnConfirm: false
            },
            function(){

                var request_data = {};

                request_data['_token']  = current_form.find('input[name=_token]').val();
                console.log(request_data['_token']);

                $.ajax({
                    type: current_form.attr('method'),
                    url: current_form.attr('action'),
                    data: request_data,
                    success: function (data) {
                        console.log(data);
                        if(data.status == 'success') {
                            // console.log('success');
                            location.reload();
                        }else if(data.status == 'fail'){
                            swal("Error!", data.message)
                        }
                    }
                });

                swal("Deleted!", "Deleted Successfully!", "success");
            });

        return false;
    }) ;

})();