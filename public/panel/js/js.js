
$('.avatar-img__input').on('change', function () {
    var input = $(this);
    if (input[0] && input[0].files && input[0].files[0]) {
        if (!input[0].files[0].type.includes("image")) {
            // $('.avatar--img').attr('src', '../img/pr3o.png');
            return false;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.avatar___img')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input[0].files[0]);
    }
});
