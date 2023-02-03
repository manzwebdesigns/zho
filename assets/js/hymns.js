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

    String.prototype.replaceAll = function(s1, s2) {
        return this.replace(
            new RegExp(  s1.replace(/[.^$*+?()[{\|]/g, '\\$&'),  'g'  ),
            s2
        );
    };

    let filter;
    $('.search-hymns').on('keyup click', function () {
        filter = $(this).val();
        if(filter.length > 0) {
            $('.card-deck .card').each(function () {
                let objThis = $(this);
                $('span.zho-found').contents().unwrap();
                objThis.hide();
                let txtValue = objThis.find('.card-text.overflow-auto').text();
                objThis.removeClass('visible');
                if (txtValue.indexOf(filter) >= 0) {
                    objThis.show();
                    objThis.addClass('visible');
                }
            });

            $('.card-deck .card.visible .card-text.overflow-auto').each(function () {
                let objThis = $(this);
                let newValue = objThis.html().replaceAll(filter, '<span class="zho-found">' + filter + '</span>');
                objThis.html(newValue);
            });
        } else {
            $('span.zho-found').contents().unwrap();
            $('.card-deck .card').show();
        }
    });
});
