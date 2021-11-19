// GET QUARTERS FOR A SPECIFIC TOWN
$(document).ready(function() {

    $("#town").change(function () {
        var slug = $(this).val();

        if(slug == '') {
            $('#search-btn').prop('disabled', true);
        }

        $('#quarter').html('');
        $.ajax({
            url: '/get-related-quarters',
            type: "get",
            data: {slug: slug},
            success: function(response) {
                // console.log(response);
                $('#search-btn').prop('disabled', false);
                $('#quarter').html('');
                response.forEach( quarter => {
                    var options = `
                        <option value="${quarter.slug}">${quarter.name}</option>
                    `;
                    $('#quarter').append(options);
                });
            },
            error: function(response) {
                console.log('Error'+response);
            }
        });

    });
});

// REQUEST CONTACT
function getContact(id) {
    event.preventDefault();
    $('#send-btn' + id).html('Precessing...');
    var mobNum = $("#contact" + id).val();
    var filter = /^\d*(?:\.\d{1,2})?$/;
    var num_length = 9;
    if (filter.test(mobNum)) {
        if(mobNum.length == num_length) {
            var user_contact = $("#contact" + id).val();
            var transport_id = $("#transport" + id).val();
            var data = {
                user_contact: user_contact,
                transport_id: transport_id
            }
            var req = $.get('/get-contact', data);
            req.done( function(resp) {
                if( resp.success )
                {
                    $.Notification.autoHideNotify('success', 'top center', 'Congratulation!','Contact information gotten successfully.')

                    $('#err-message'+id).html('');
                    $('#message' + id).attr('class', 'alert alert-success shadow');
                    $('#message' + id).html(`
                        <h4 style="color: black;"><i class="mdi mdi-check-all"></i> Success!</h4>
                        <hr/>
                        Please <strong style="color: black">Call</strong> or <strong style="color: black">WhatsApp</strong> the number provided below.
                        <h4 class="pt-3">TEL: <a href="tel:+237${resp.contact}" class="modal-rst-phone">(+237) ${resp.contact}</a></h4>
                    `);
                    $('#send-form' + id).html('');
                    $('#show-contact' + id).attr('class', 'pt-1 pb-3');
                    // $('#show-contact' + id).html('TEL: +237 '+ resp.contact);

                    setTimeout(function() {
                        $('#show-contact' + id).attr('class', 'pt-1 pb-3');
                        $('#show-contact' + id).html('');
                        $('#message'+id).attr('class', 'alert alert-warning show');
                        $('#message'+id).html('<h4 style="color: black;"> <i class="mdi mdi-clock-alert"></i> Timed out!</h4> <hr/> Please <strong style="color: black">refresh</strong> to continue.');
                    }, 200000);
                }
            });

        } else {
            // alert('Please put ' + num_length + '  digit mobile number');
            $.Notification.notify('error', 'top center', 'Validation error','Please put ' + num_length + '  digit mobile number')
            $('#send-btn' + id).html('Proceed to get contact');
            return false;
        }
    } else {
        alert('Not a valid number');
        $('#send-btn' + id).html("Proceed to get contact");
        return false;
    }
}


// SLICK SLIDER
$('.type-bx').slick({
    dots: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    prevArrow: false,
    nextArrow: false,
    responsive: [
    {
        breakpoint: 500,
        settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        }
    }
    ]
});
