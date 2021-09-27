$(document).ready(function() {



    const $registerForm = $('#contactForm')
    let validator = void(0)

    if ($registerForm.length) {
        validator = $registerForm.validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true
                },
                subject: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: 'Unesite puno ime'
                },
                email: {
                    required: 'Unesite e-mail',
                    email: 'E-mail adresa nije ispravnog formata'
                },
                message: {
                    required: 'Unesite poruku'
                },
                subject: {
                    required: 'Unesite naslov e-maila'
                }
            },
            submitHandler: function submitHandler(form) {
                event.preventDefault();
                $.ajax({
                    url: 'php_vendors/sendemail.php',
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

                            });
                        }

                    }
                })
            }
        })
    }

});