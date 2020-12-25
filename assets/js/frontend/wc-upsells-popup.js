jQuery(function($) {

    $(document.body).on('added_to_cart', function(e, data) {

        if (data['div.upsells-popup-checkout']) {
            $('div.upsells-popup').modal('hide');
            window.location.href = data['div.upsells-popup-checkout'];
            return;
        }

        if (!data['div.upsells-popup']) {
            return;
        }

        setTimeout(function() {
            $(document.body).append(data['div.upsells-popup']);

            var $modal = $('div.upsells-popup');

            $modal.one('show.bs.modal', function() {
                if ($modal.find('img.lazy')) {
                    $modal.find('.lazy').lazy();
                }
                var $slider = $modal.find('.owl-products');

                var config = $slider.data();

                config.responsive = {
                    '0': {items:2, margin:30},
                    '992': {items:4, margin:30}
                };

                config.navText = [ '<i class="pe-7s-angle-left"></i>', '<i class="pe-7s-angle-right"></i>' ];

                if ( $('body').hasClass('rtl') ) {
                    config.rtl = true;
                }

                $slider.owlCarousel(config);
            });

            $modal.one('hidden.bs.modal', function() {
                $modal.remove();
            });

            $modal.modal('show');
        }, 500);
    });
});
