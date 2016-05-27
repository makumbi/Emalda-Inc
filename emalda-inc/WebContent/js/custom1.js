//code for the left nav scrollspy functionality.  
!function($) {

    $(function() {

        var $window = $(window);
        var $body = $(document.body);

        var navHeight = $('.navbar').outerHeight(true) + 20;

        $body.scrollspy({
            target: '.bs-sidebar',
            offset: navHeight
        });

        $window.on('load', function() {
            $body.scrollspy('refresh');
            fixNavbarIssue();
        });

        $('.bs-docs-container [href=#]').click(function(e) {
            e.preventDefault();
        });

        // back to top
        setTimeout(function() {
            
            var $sideBar = $('.bs-sidebar');

            $sideBar.affix({
                offset: {
                    top: function() {
                        var offsetTop = $sideBar.offset().top;
                        var sideBarMargin = parseInt($sideBar.children(0).css('margin-top'), 10);
                        var navOuterHeight = $('.bs-docs-nav').height();
                        return (this.top = offsetTop - navOuterHeight - sideBarMargin);
                    }
                    , bottom: function() {
                        return (this.bottom = $('.bs-footer').outerHeight(true));
                    }
                }
            });
        }, 300);
    });

}(window.jQuery);

function fixNavbarIssue() {
    
    var sidenavTopMargin = parseInt($(".bs-sidenav").css("margin-top"), 10);
    
    if ($(document).width() > 768) {  // Required if "viewport" content is "width=device-width, initial-scale=1.0": navbar is not fixed on lower widths.

        var urlHash = window.location.hash;
        // Code below fixes the issue if you land directly onto a page section (http://domain/page.html#section1)
        
        if (urlHash !== "") {
            
            var scrollTo = ($(urlHash).offset().top) - $(".navbar-fixed-top").height() - sidenavTopMargin;
            $(document).scrollTop(scrollTo);
        }

        // This adds any <a> element 
        var locationHref = window.location.protocol + '//' + window.location.host + $(window.location).attr('pathname');
        var anchorsList = $('a').get();

        for (i = 0; i < anchorsList.length; i++) {
            var hash = anchorsList[i].href.replace(locationHref, '');
            if (hash[0] === "#" && hash !== "#") {
                var originalOnClick = anchorsList[i].onclick; // Retain your pre-defined onClick functions
                setNewOnClick(originalOnClick, hash);
            }
        }
    }

    function setNewOnClick(originalOnClick, hash) {
        anchorsList[i].onclick = function() {
            $(originalOnClick);
            var scrollTo = ($(hash).offset().top) - $(".navbar-fixed-top").height() - sidenavTopMargin;
            $(document).scrollTop(scrollTo);
            return false;
        };
    }  
}




