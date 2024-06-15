jQuery(document).ready(function($) {
    $(document).on('click', '.convert-to-image', function() {
        var quote = $(this).prev('blockquote');

        // Create a new element to capture
        var capture = $('<div></div>').css({
            'position': 'absolute',
            'left': '-9999px',
            'padding': '20px',
            'background': '#fff',
            'font-family': 'Arial, sans-serif'
        }).append(quote.clone());

        $('body').append(capture);

        html2canvas(capture[0]).then(function(canvas) {
            var imgData = canvas.toDataURL('image/png');

            // Display image in a popup
            var imgPopup = $('<div class="image-popup"><span class="close">&times;</span><img src="' + imgData + '"></div>');
            $('body').append(imgPopup);

            // Close button functionality
            $('.image-popup .close').click(function() {
                $('.image-popup').remove();
            });

            capture.remove();
        });
    });
});
