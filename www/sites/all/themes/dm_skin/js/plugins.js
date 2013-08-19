var tab_maps = [];

(function($) {
  Drupal.behaviors.dm_skin = {
    attach : function(context, settings) {

      if ($('#block-panels-mini-facet-orientation-map .filtres .filtre-linner').length) {
        $('#block-panels-mini-facet-orientation-map .filtres .filtre-linner').hide();
        jQuery('.filtre h3').on('click', function(){
          var $this = $(this);
          console.log($this);
          var $filtre_inner = $this.next('#block-panels-mini-facet-orientation-map .filtres .filtre-linner');
          var $filtre = $this.parents('.filtre');
          if ($filtre_inner.is(':visible')) {
            $filtre_inner.slideUp();
            $this.removeClass('open');
          } else {
            if (!$filtre.hasClass('disabled')) {
              $filtre_inner.slideDown();
              $this.addClass('open');
            }
          };
        });
        jQuery('#block-panels-mini-facet-orientation-map .filtres div:first-child h3').click();
      }

      jQuery('.pane-quicktabs-formations .filtre-linner').show();

      if ($('.carousel-hp').length) { // Carousel Homepage
        $('.carousel-hp').flexslider({
          itemWidth: 630,
          directionNav: false
        });
      }

      if ($('.carousel-shp').length) { // Carousel commun
        $('.carousel-shp').flexslider({
          itemWidth: 630,
          directionNav: false
        });
      }
      // Carousel vidéo
      if ($('.carousel-videos').length) {
        $('.carousel-videos').flexslider({
          animation: "slide",
          itemWidth: 186,
          controlNav: false,
          move: 1
        });
      }
      // toogle connexion
      $('#toogle-connexion a').bind('click', function() {
        $('#user-bar').slideToggle("fast");
        //event.preventDefault();
      });
      // static maps
      $('.static-map').each(function(){
        var $this = $(this);
        var lat = $this.attr('data-lat');
        var lng = $this.attr('data-lng');
        create_static_map(this, lat, lng);
      });

      // Accordéon
      if ($('.accordeon').length) {
        $('.accordeon .content').hide();
        jQuery('.accordeon h2').on('click', function(e) {
          var item = $(this).parent('li');
          if (item.hasClass('active')) {
            item.find('.content').slideUp();
            item.removeClass('active');
          }
          else {
            $('.accordeon .content').slideUp();
            $('.accordeon li').removeClass('active');
            item.find('.content').slideDown(400, function() {
              //resize_maps();
            });
            item.addClass('active');
          }
        });
        // ouvre le premier élément
        $('.accordeon li:first-child h2').click();
        // ouvre tous les éléments
        jQuery('.ouvre-accordeons').on('click', function(e) {
          $('.accordeon .content').slideDown();
          $('.accordeon li').addClass('active');
        });
      }
    }
  };
  function create_static_map (element, lat, lng) {
    var myLatLng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
      center: myLatLng,
      zoom: 15,
      disableDefaultUI: true,
      disableDoubleClickZoom: true,
      draggable: false,
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(element,
        mapOptions);
    var myMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: '/sites/all/themes/custom/dm_skin/images/picto/marker_gmap.png'
    });
    tab_maps.push({
      map: map,
      lat: lat,
      lng: lng
    });
  };

  function resize_maps () {
    for (var i = 0; i < tab_maps.length; i++) {
      google.maps.event.trigger(tab_maps[i].map,'resize');
      tab_maps[i].map.setCenter(new google.maps.LatLng(tab_maps[i].lat, tab_maps[i].lng));
    }
  };

})(jQuery);

function create_info_window(map, infowindow, title, content, marker) {
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent("<div class='infowindow'><h2>" + title + "</h2>" + content + "</div>");
    infowindow.open(map, marker);
    console.log(map + infowindow + title + content + marker);
  });
}
