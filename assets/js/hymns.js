$('document').ready(function () {
    $('.play-hymn').click(function () {
        const stopPlayer = (function (thisPlayer) {
            thisPlayer.trigger('pause');
            document.getElementById(thisPlayer.attr('id')).currentTime = 0;
        });

        let thisBtn = $(this),
            player = thisBtn.siblings()[4];

        if (!thisBtn.hasClass('playing')) {
            player.play();
            thisBtn.html('<i class="fas fa-stop"></i>').addClass('playing');
        } else {
            stopPlayer($(player));
            thisBtn.removeClass('playing').html('<i class="fas fa-play"></i>');
        }

        $('audio').each(function () {
            let thisPlayer = $(this),
                audioBtn = thisPlayer.parent().find('.playing');
            if(audioBtn.length) {
                if(audioBtn.offsetParent().attr('id') !== thisBtn.offsetParent().attr('id')) {
                    stopPlayer($(thisPlayer));
                    audioBtn.removeClass('playing').html('<i class="fas fa-play"></i>');
                }
            }
        });
    });

    $('.search-hymns').on('keyup click', function () {
        let filter = $(this).val();
        if(filter.length > 0) {
            $('.card-deck .card').each(function () {
                let objThis = $(this);
                objThis.hide();
                let txtValue = objThis.text().toUpperCase();
                if (txtValue.indexOf(filter.toUpperCase()) >= 0) {
                    objThis.show();
                }
            });
        } else {
            $('.card-deck .card').show();
        }
    });
});
