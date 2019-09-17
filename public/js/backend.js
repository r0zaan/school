$(document).ready(function ($) {
    $("table").wrap("<div class='table-responsive'></div>");
    var url;

    $(document).on('click', '.ajax-modal', function () {
        url = $(this).attr('data-url');
        if ($(this).attr('data-map') === "view-map") {
            $('.ajax-form-model .modal-dialog').css('width', '1200px');

        } else {
            $('.ajax-form-model .modal-dialog').css('width', '600px');
        }
        $('.ajax-form-model').modal();
    });

    $('.ajax-form-model').on('shown.bs.modal', function () {
        $('.ajax-form-model .panel-body').load(url, function () {
            $(function () {
                //Initialize Select2 Elements
                $(".select2").select2();
                $('.textarea').wysihtml5()
                // CKEDITOR.replace('editor1')
                $("#example3").dataTable();
                $("#salesDetails").dataTable({searching: false, paging: false, bInfo: false});
                $("#salesDetails").css("font-size", 13);
                if ($('.ajax-modal').hasClass('view-map')) {
                    viewMap();
                }
            });
        });
    });

    $('.ajax-form-model').on('hidden.bs.modal', function () {
        $(".ajax-form-model .panel-body").html('');
        var prep_content = $('.prep').html();
        $(".ajax-form-model .panel-body").html(prep_content);

    });


    //ajax form submit
    (function () {

        $(document).on('submit', '.ajax-form-post', function () {
            $('.error-message').each(function () {
                $(this).removeClass('make-visible');
                $(this).html('');
            });

            $('.load-after').removeClass('hidden');

            $('input').each(function () {
                $(this).removeClass('errors');
            });

            var url = $(this).attr('action');

            var form = $(this);
            var formData = false;
            if (window.FormData) {
                formData = new FormData(form[0]);
            }

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
                url: url,
                data: formData ? formData : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    console.log(response);
                    if (response.status == 'success') {
                        //console.log(response.return_url);
                        window.location.href = response.return_url;
                    }
                    if (response.status == 'fail') {
                        $('.load-after').addClass('hidden');
                        for (var key in response.errors) {
                            //console.log(response);
                            var error_message = response.errors[key];

                            var error_form_field = form.find("[name=" + key + "]");
                            error_form_field.addClass('errors');
                            error_form_field.parent().find('.error-message').addClass('make-visible').html(error_message);
                        }
                    }
                }
            });

            return false;

        });

    })();
    (function () {
        $(document).on('click', '.exported', function (e) {
            swal("Exported", 'Successfully Downloaded', "success")
        });
        $('.delete-data-ajax').css('display', 'inline');
        $(document).on('submit', 'form.delete-data-ajax', function (e) {

            var current_form = $(this);

            swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete this!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Yes, Delete it!",
                    closeOnConfirm: false
                },
                function () {

                    var request_data = {};

                    request_data['_token'] = current_form.find('input[name=_token]').val();

                    $.ajax({
                        type: current_form.attr('method'),
                        url: current_form.attr('action'),
                        data: request_data,
                        success: function (data) {
                            console.log(data);
                            if (data.status == 'success') {
                                location.reload();
                            }
                            if (data.status === 'fail') {
                                swal("Cannot Delete!",
                                    data.message, "error");
                            }
                        }
                    });

                    swal("Deleted!", "Deleted Successfully!", "success");
                });

            return false;
        });
        $(document).on('submit', 'form.restore-data-ajax', function (e) {

            var current_form = $(this);
            swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to restore this!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3e9953 ",
                    confirmButtonText: "Yes, Restored it!",
                    closeOnConfirm: false
                },
                function () {

                    var request_data = {};

                    request_data['_token'] = current_form.find('input[name=_token]').val();

                    $.ajax({
                        type: current_form.attr('method'),
                        url: current_form.attr('action'),
                        data: request_data,
                        success: function (data) {
                            console.log(data);
                            if (data.status == 'success') {
                                location.reload();
                            }
                        }
                    });

                    swal("Restored!", "Restore Successfully!", "success");
                });

            return false;
        });

    })();
    (function () {
        $(document).on('submit', '.ajax-form-import', function () {

            $('.error-message').each(function () {
                $(this).removeClass('make-visible');
                $(this).html('');
            });

            $('input').each(function () {
                $(this).removeClass('errors');
            });
            $('.loader-report img.loader').addClass('make-visible');
            var url = $(this).attr('action');

            var form = $(this);
            var formData = false;
            if (window.FormData) {
                formData = new FormData(form[0]);
            }

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
                url: url,
                data: formData ? formData : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $('.loader-report img.loader').removeClass('make-visible');
                        swal({
                            title: "Imported!",
                            text: "Successfully Imported",
                            type: "success"
                        }, function () {
                            var href = document.URL;
                            location.reload();
                        });
                    }
                    if (response.status == 'fail') {
                        $('.loader-report img.loader').removeClass('make-visible');
                        for (var key in response.errors) {
                            //console.log(response);
                            var error_message = response.errors[key];
                            var error_form_field = form.find("[name=" + key + "]");
                            error_form_field.addClass('errors');
                            error_form_field.parent().find('.error-message').addClass('make-visible').html(error_message);
                        }
                        swal("File Not uploaded", 'Error File Not Imported', "error");
                    }
                    if (response.status == 'error') {
                        $('.loader-report img.loader').removeClass('make-visible');
                        swal({
                            title: "Imported!",
                            text: "Exist Or Syntax Error\n" +
                                "Check In Excel!! ",
                            type: "success"
                        }, function () {
                            window.location.href = response.url;
                        });
                    }
                }
            });

            return false;

        });
    })();

// for active class
    var url = window.location;

// for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');

// for treeview
    $('ul.treeview-menu a').filter(function () {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active').addClass('menu-open');


    $('#selectAll').click(function () {
        if ($(this).prop('checked') == true) {
            $('.select').each(function () {
                console.log($('#selectAll').prop('checked'));
                $(this).prop('checked', true);
            });
        } else {
            $('.select').each(function () {
                console.log($('#selectAll').prop('checked'));
                $(this).prop('checked', false);
            });
        }
    });
    $('#trashAll').click(function () {
        if ($(this).prop('checked') == true) {
            $('.selectTrash').each(function () {
                console.log($('#trashAll').prop('checked'));
                $(this).prop('checked', true);
            });
        } else {
            $('.selectTrash').each(function () {
                console.log($('#trashAll').prop('checked'));
                $(this).prop('checked', false);
            });
        }
    });
    //for dynamic Form
    $(document).on('click', '.delete', function (e) {
        swal({
                title: "Are you sure?",
                text: "Are you sure you want to Delete the selected one!",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Yes, Delete it!",
                closeOnConfirm: false
            },
            function () {
                var id = [];
                var location = document.URL;
                $('.select').each(function (e) {
                    if (this.checked) {
                        id[e] = this.id;
                    }
                });
                if (id.length === 0) {
                    swal("Nothing Selected", 'Error in Deleted', "error");
                } else {
                    console.log(id);
                    var href = location + '/selectDelete';
                    var header = {'X-CSRF-TOKEN': $('input[name=_token]').val()};
                    $.ajax({
                        headers: header,
                        url: href,
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_method": 'POST'
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                console.log("it Work");
                                swal("Deleted", 'Successfully Deleted', "success");
                                window.location.href = location;
                            }
                            if (data.status == 'fail') {
                                console.log("It failed");
                                swal("Cant Delete", 'Could not be Deleted', "error");
                            }
                        }
                    });
                }
            });
    });

    $(document).on('click', '.deleteTrash', function (e) {
        swal({
                title: "Are you sure?",
                text: "Are you sure you want to Delete the selected one!",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Yes, Delete it!",
                closeOnConfirm: false
            },
            function () {
                var id = [];
                var location = document.URL;
                $('.selectTrash').each(function (e) {
                    if (this.checked) {
                        id[e] = this.id;
                    }
                });
                if (id.length === 0) {
                    swal("Nothing Selected", 'Error in Deleted', "error");
                } else {
                    console.log(id);
                    var href = location + '/selectPermanentDelete';
                    var header = {'X-CSRF-TOKEN': $('input[name=_token]').val()};
                    $.ajax({
                        headers: header,
                        url: href,
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_method": 'POST'
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                console.log("it Work");
                                swal("Deleted", 'Successfully Deleted', "success");
                                window.location.href = location;
                            }
                            if (data.status == 'fail') {
                                swal("Cant Delete", 'Could not be Deleted', "error");
                            }
                        }
                    });
                }
            });
    });


    function viewMap() {
        var icon = new google.maps.MarkerImage(APP_URL + "/img/bluePinPoint.png");
        var location = $('#lat-lng').val();
        locations = location.split(',');
        console.log(locations);
        var map = new google.maps.Map(document.getElementById('map-view'), {
            zoom: 16,
            center: new google.maps.LatLng(locations[0], locations[1]),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        console.log(document.getElementById('map-view'));

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        marker = new google.maps.Marker({
            icon: icon,
            position: new google.maps.LatLng(locations[0], locations[1]),
            map: map
        });

    }

    // Speaker
    $(document).on('click','.add-speaker',function () {
        var speaker = $('.speaker').val();
        $('.error-message').each(function () {
            $(this).removeClass('make-visible');
            $(this).html('');
        });
        console.log(speaker);
        if(speaker === '' || speaker === 0){
            var error_message = "cant be null or 0";
            var error_form_field = $(document).find("[name=speaker]");
            error_form_field.addClass('errors');
            error_form_field.parent().find('.error-message').addClass('make-visible').html(error_message);
        }else{
            let speakerDiv = $('.speaker-div').html();
            let StoredHtml = "";
            for(let i=1; i<= speaker;i++){
            StoredHtml += speakerDiv;
            }
            $('.speaker-div-show').html(StoredHtml);
        }
    })



});
