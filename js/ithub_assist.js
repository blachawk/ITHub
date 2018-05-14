/*NFFA - IT HUB | MODIFIED BY KLEWIS 2018-05-10  */

(function ($) {

    // test jquery works | console.log($);

    //DEFINE SCRIPTS
    function scrollbackup() {

        var scrollTop = $(".ithub-scroll-btn");

        $(window).scroll(function () {

            var topPos = $(this).scrollTop();
            if (topPos > 20) {
                $(scrollTop).fadeIn();
            } else {
                $(scrollTop).fadeOut();
            }
        }); // scroll END

        //Click event to scroll to top
        $(scrollTop).click(function () {
            $('html, body').animate({
                scrollTop: 0
            }, 400);
            return false;
        }); // click() scroll top EMD
    }

    function gaTrackClicks() {

        /* GOOGLE ANAYLTICS - EVENT ACTIONS */

        $('a[href$=".pdf"]').on('click', function () {
            if (typeof ga !== 'undefined') {
                console.log('we are clear to now process a ga event');
                //ga('send', 'event', 'QR_Win_A_Grand', 'Clicked_through_to_register');
                ga('send', 'event', 'IT Hub Tabs', 'click', 'Tab Clicks', 0);
            }
        });

        //*/
    }

    function carousel() {
        $('.carousel').carousel({
            interval:false //SET THIS VALUE TO 7000 WHEN WE HAVE SLIDES
          });
    }

    function searchhelper() {

      //  $("#mSearchList").addClass("d-none");

        //FILTER BS4 LIST ITEMS BASED ON INPUT CHARACTERS
        $('#s').on('input',function(e){
            let input = $(this).val()
            let filter = input.toUpperCase()
                    
            if( input.length === 0 ) {
               $("#mSearchList").addClass("ithub-initial-hide");//d-none
            } else {
                $("#mSearchList").removeClass("ithub-initial-hide");//d-none
            }

            $('.list-group .list-group-item').each(function() {
              let li = $(this)
              let anchor = li.children('a')
              // Filter by text
              // if(anchor.text().toUpperCase().indexOf(filter) > -1) {
              // Filter by meta
              if(anchor.data('meta').toUpperCase().indexOf(filter) > -1) {
                //WE HAVE A MATCH, SO LETS FADE THESE IN FROM 0 OPACITY TO 100%
                li.removeClass('d-none').addClass('ithub-fadeIn');//d-none
               // li.find('a').addClass('visible');
              } else {
                //WE DON'T HAVE A MATCH SO SET OPACITY TO 0 ON THESE LI ITEMS RIGHT AWAY
                li.addClass('d-none').removeClass('ithub-fadeIn');//d-none
                //li.find('a').removeClass('invisible').addClass('visible');
              }
            });
        });
    }

    //RUN SCRIPTS
    scrollbackup();
    gaTrackClicks();
    carousel();
    searchhelper();

})(jQuery);