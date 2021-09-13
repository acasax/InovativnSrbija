$(document).ready(function() {

    $(this).scrollTop(0);

    const $form = $('#contact')
    let validator = void(0)

    if ($form.length) {
        validator = $form.validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                subject: {
                    required: true,
                },
                message: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: 'Please enter your name.'
                },
                email: {
                    required: 'Please enter your e-mail address.',
                    email: 'Your e-mail address is not valid'
                },
                subject: {
                    required: 'Please enter subject.'
                },
                message: {
                    required: 'Please enter your message.'
                }
            },
            submitHandler: function submitHandler(form) {
                event.preventDefault();
                $.ajax({
                    url: 'contact.php',
                    method: 'POST',
                    data: new FormData(form),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        let objResp = JSON.parse(data);
                        let str = objResp.type;
                        if (str === 'ERROR') {
                            str = objResp.data;
                            swal({
                                title: "ERROR",
                                text: str,
                                timer: 2500,
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: "error"
                            });
                            return;
                        }

                        if (str === 'OK') {
                            str = objResp.data;
                            swal({
                                    title: "SUCCESS",
                                    text: str,
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    type: "success",

                                },
                                function(isConfirm) {
                                    $(location).attr('href', 'index.php');
                                }
                            );
                        }

                    }
                })
            }
        })
    }
});