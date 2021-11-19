var counter = 0;
setInterval(function () {
    var c = counter % $('.icon-box').length;
    $('.icon-box').removeClass('active');
    $('.icon-box').eq(c).addClass('active');
    ++counter
}, 2000);

$(document).ready(function () {
    // var first_slug = $('#town').find("option:first-child").val();

    $('#quarter').html('');
    $('#search-btn').prop('disabled', true);

    $("#town").change(function () {
        var slug = $(this).val();

        if (slug == '') {
            $('#search-btn').prop('disabled', true);
        }

        $('#quarter').html('');
        $.ajax({
            url: '/get-related-quarters',
            type: "get",
            data: { slug: slug },
            success: function (response) {
                // console.log(response);
                $('#search-btn').prop('disabled', false);
                $('#quarter').html('');
                response.forEach(quarter => {
                    var options = `
                                <option value="${quarter.slug}">${quarter.name}</option>
                                `;
                    $('#quarter').append(options);
                });
            },
            error: function (response) {
                console.log('Error' + response);
            }
        });
    });
});

// OWL

$('#owl-demo').owlCarousel({
    nav: false,
    autoplay: true,
    loop: true,
    margin: 20,
    responsive: {
        0: {
            items: 1
        },
        480: {
            items: 2
        },
        700: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
});
