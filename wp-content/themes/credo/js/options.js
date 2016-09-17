jQuery(document).ready(function() {
    "use strict";

    var wind_href = window.location.href;  

    /* Google Maps */

    var styleArray = [{
        featureType: "all",
        stylers: [{
            saturation: -80
        }]
    }, {
        featureType: "road.arterial",
        elementType: "geometry",
        stylers: [{
            hue: "#000000"
        }, {
            saturation: 50
        }]
    }, {
        featureType: "poi.business",
        elementType: "labels",
        stylers: [{
            visibility: "off"
        }]
    }];

    function initialize() {
        var mapCanvas = document.getElementsByClassName('map');
        var maps = [];
        
        jQuery(mapCanvas).each(function(i){

            var lati = jQuery(this).data('lat');
            var longi = jQuery(this).data('long');
            var icon = jQuery(this).data('icon');

            var mapOptions = {
                center: new google.maps.LatLng(lati, longi),
                zoom: 12,
                styles: styleArray,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            maps[i] = new google.maps.Map(mapCanvas[i], mapOptions);

            var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(lati, longi),
                        map: maps[i],
                        icon: icon,
                    });
        });
    }

    function initialize_one() {
        var mapCanvas = document.getElementsByClassName('map-canvas');
        var Options = mapCanvas[0].getAttribute('data-pin');
        var mapLatLng = new google.maps.LatLng(42.5722437,-71.9915749);
        var map;

        var mapOptions = {
            center: mapLatLng,
            zoom: 10,
            styles: styleArray,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(mapCanvas[0], mapOptions);

        var markers = [];

        var parse = JSON.parse(Options);

        if(parse.locations) {

            jQuery.each(parse.locations, function (i, val) {

                var pos = new google.maps.LatLng(val.latitude, val.longitude);

                markers[i] = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: val.pin,
                });


                var bounds = new google.maps.LatLngBounds();

                for(i=0; i<markers.length; i++) {
                    bounds.extend(markers[i].getPosition());
                }

                map.fitBounds(bounds);
                var listener = google.maps.event.addListener(map, "idle", function() { 
                    map.setZoom(map.getZoom() - 1); 
                    google.maps.event.removeListener(listener); 
                }); 
                

            });
        }

    }

    if(jQuery('.map-canvas').length) {
        google.maps.event.addDomListener(window, 'load', initialize_one);
    }

    if(jQuery('.map').length) {
        google.maps.event.addDomListener(window, 'load', initialize);
    }

    jQuery('#calendar').datepicker({
        firstDay: 1,
        onSelect: function(date) {
            jQuery('.load-events').addClass('hidden');
            var url = window.location.href.toLowerCase().indexOf("?date=") >= 0 ? wind_href.slice(0,wind_href.indexOf('?')) : wind_href;
            window.history.replaceState( {} , '' , url + '?date=' + date );
            jQuery('.main-loader').addClass('visible');
            jQuery('.event-sel-date').text(jQuery.datepicker.formatDate('dd M yy', new Date(date)));
            jQuery( ".events-container" ).load(ajaxurl, { action: 'events_load', e_date: date }, function(){
                initialize();
                setTimeout(function(){
                    jQuery('.main-loader').removeClass('visible');
                }, 300)
            });
        }
    });

    jQuery('.load-events').on('click', function(){
        var elem = jQuery(this);
        var off = elem.attr('data-offset');
        var text = elem.text();

        elem.attr('data-offset', Number(off) + Number(5));
        elem.text('Loading...');

        if(Number(off) + 5 >= Number(elem.attr('data-count'))) elem.addClass('hidden');

        jQuery.ajax({
            url: ajaxurl,
            data: { action: 'events_load', offset: Number(off) },
            type: 'POST',
            success: function (result) {
                jQuery(result).appendTo('.events-container').hide().fadeIn(600);
                elem.text(text);
                setTimeout(function(){
                    initialize();
                }, 700);
            },
        });   
    });

    jQuery('.load-sermons').on('click', function(){
        var elem = jQuery(this);
        var off = elem.attr('data-offset');
        var cat = elem.attr('data-category');
        var col = elem.attr('data-columns');
        var text = elem.text();

        elem.attr('data-offset', Number(off) + Number(8));
        elem.text('Loading...');

        if(Number(off) + 8 >= Number(elem.attr('data-count'))) elem.addClass('hidden');

        jQuery.ajax({
            url: ajaxurl,
            data: { action: 'sermons_load', offset: Number(off), category: cat, columns: col },
            type: 'POST',
            success: function (result) {
                jQuery(result).appendTo('.sermons-container').hide().fadeIn(600);
                elem.text(text);
            },
        });   
    });

    /* COUNTDOWN */
    var cd_duedate = jQuery('#the-countdown').attr('data-duedate');
    var cd_start = new Date().getTime();
    var cd_end = new Date(cd_duedate).getTime();
    jQuery('#the-countdown').countdown(cd_duedate, function(event) {
        var $this = jQuery(this);
        // Total days
        var days = Math.round(Math.abs((cd_start - cd_end)) / (24 * 60 * 60 * 1000));
        var divider = {
            'seconds': 60,
            'minutes': 60,
            'hours': 24
        };
        var progress = null;
        switch (event.type) {
            case "seconds":
            case "minutes":
            case "hours":
            case "days":
            case "weeks":
            case "daysLeft":
                $this.find('#' + event.type).html(event.value);
                if (event.type === 'days') {
                    progress = ((days - event.value) * 100) / (days);
                } else {
                    progress = (100 / divider[event.type]) * (divider[event.type] - event.value);
                }
                break;
            case "finished":
                $this.hide();
                break;
        }
    });

    jQuery('.like-heart').on('click', function(){

        var box = jQuery(this);
        var post_id = box.data('id');
        var likes = parseInt(box.find('span').text(),10);
        
        if(box.find('i').hasClass('liked')) return;
        
        jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {action: 'post_likes', postid:post_id},
        })
        .done(function(result) {
                if(result == true) {
                    likes++;
                    box.find('span').text(likes);
                    box.find('i').removeClass('fa-heart-o').addClass('liked fa-heart')
                }
        })
        .fail(function() {
                console.log("error-ajax");
        });
    });
    
    jQuery(".responsive-menu").on('click',function(e) {
        jQuery(".main-nav>ul").toggle();
        e.stopPropagation();
        if (e.preventDefault)
            e.preventDefault();
        return false;
    });
    jQuery("body").on('click',function() {
        jQuery(".main-nav>ul").css({
            display: "none"
        });
    });
    jQuery(".swipebox").swipebox();


    jQuery('.contact-form-1, .contact-form-2, .contact-form-3').each(function() {
        var t = jQuery(this);
        var t_result = jQuery(this).find('.form-send');
        var t_result_init_val = t_result.val();
        var validate_email = function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        };
        var t_timeout;
        t.submit(function(event) {
            event.preventDefault();
            var t_values = {};
            var t_values_items = t.find('input[name],textarea[name]');
            t_values_items.each(function() {
                t_values[this.name] = jQuery(this).val();
            });
            if (t_values['contact-name'] === '' || t_values['contact-email'] === '' || t_values['contact-message'] === '') {
                t_result.val('Please fill in all the required fields.');
            } else
            if (!validate_email(t_values['contact-email']))
                t_result.val('Please provide a valid e-mail.');
            else
                jQuery.post("php/contacts.php", t.serialize(), function(result) {
                    t_result.val(result);
                });
            clearTimeout(t_timeout);
            t_timeout = setTimeout(function() {
                t_result.val(t_result_init_val);
            }, 3000);
        });

    });

});