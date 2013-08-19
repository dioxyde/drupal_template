var $j = jQuery.noConflict();
// à partir d'ici :
// $j est un alias de jQuery 1.9.1
// $ reste l'alias de jQuery 1.4

var tab_maps = [];

(function($) {
  // dans ce bloc, $ fait référence à la dernière version de jQuery (1.9.1)
  // car $j est passé en paramètre (voir accolade fermante en bas du fichier)

  $(function(){ // DOM ready

    // nav
    // on separe les sous-menus en deux colonnes
    $('.sous-nav > ul').each(function(){
      var $this = $(this);
      var tab_item = $this.find('> li');
      var nb_items = tab_item.length;
      var $new_ul = $('<ul>');
      for (var i = Math.ceil(nb_items/2); i < nb_items; i++) {
        $new_ul.append(tab_item[i]);
      };
      $this.after($new_ul);
    });

    // au chargement, on masque les sous-nav
    $('.sous-nav').hide();
    // au rollover, ouverture des sous-nav
    $('.level-0 > li').hover(
      function(){
        $(this).addClass('open');
        $(this).find('.sous-nav').show();
      },
      function(){
        $(this).removeClass('open');
        $(this).find('.sous-nav').hide();
      }
    );

    // ajoute les placeholder
    $('.form-text').placeholder();

    // boîte à onglets
    // au chargement, on masque les panels
    $('#panels .panel').hide();
    $('#onglets .onglet').on('click', function(e){
      e.preventDefault();
      var $this = $(this);
      var target_panel = $this.attr('href');
      $('#onglets .onglet').removeClass('on');
      $this.addClass('on');
      $('#panels .panel').hide();
      $(target_panel).show();
    });
    // on active le premier panel
    $('#onglets .onglet:first-child').trigger('click');

    // carousel HP
    $('.carousel-hp').flexslider({
      itemWidth: 630,
      directionNav: false
    });

    // carousel SHP
    $('.carousel-shp').flexslider({
      itemWidth: 630,
      directionNav: false
    });

    // carousel vidéos
    $('.carousel-videos').flexslider({
      animation: "slide",
      itemWidth: 186,
      controlNav: false,
      move: 1
    });

    // formulaires : blocs repliables de choix multiple
    $('.bloc-choix-content').hide();
    $('.bloc-choix-multiple h3').on('click', function(){
      var $this = $(this);
      var $bloc_choix_content = $this.next('.bloc-choix-content');
      var $bloc_choix = $this.parents('.bloc-choix-multiple');
      if ($bloc_choix_content.is(':visible')) {
        $bloc_choix_content.slideUp();
        $this.removeClass('open');
      } else {
        if (!$bloc_choix.hasClass('disabled')) {
          $bloc_choix_content.slideDown();
          $this.addClass('open');
        }
      };
    });

    // formulaires : création des arbos de choix multiple
    $('.bloc-choix-multiple').each(function(){
      init_tree($(this));
    });

    // serp : blocs repliables de filtres
    $('.filtre-inner').hide();
    $('.filtre h3').on('click', function(){
      var $this = $(this);
      var $filtre_inner = $this.next('.filtre-inner');
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
    // au début, on n'affiche que les 5 premiers filtres des listes
    $('.filtres .filtre li:nth-child(n+6)').hide();
    $('.filtre .lien-tout').on('click', function(){
      var $this = $(this);
      var $filtre = $this.parents('.filtre');
      if ($filtre.find('li:visible').length > 5) {
        $filtre.find('li:nth-child(n+6)').hide();
      } else {
        $filtre.find('li').show();
      };
    });

    // listing-programmes
    if ($('.listing-programmes').length) {
      $('.bt-liste-compacte').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.addClass('active');
        $('.bt-liste-detaillee').removeClass('active');
        $('.listing-programmes li p').slideUp();
      });
      $('.bt-liste-detaillee').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.addClass('active');
        $('.bt-liste-compacte').removeClass('active');
        $('.listing-programmes li p').slideDown();
      });
      $('.bt-liste-detaillee').click();
    };

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
      $('.accordeon h2').on('click', function(e) {
        var item = $(this).parent('li');
        if (item.hasClass('active')) {
          item.find('.content').slideUp();
          item.removeClass('active');
        }
        else {
          if ($('.accordeon .content:visible').length < 2) {
            $('.accordeon .content').slideUp();
            $('.accordeon li').removeClass('active');
          };
          item.find('.content').slideDown(400, function() {
            resize_maps();
          });
          item.addClass('active');
        }
      });
      // ouvre le premier élément
      $('.accordeon li:first-child h2').click();
      // ouvre tous les éléments
      $('.ouvre-accordeons').on('click', function(e) {
        $('.accordeon .content').slideDown();
        $('.accordeon li').addClass('active');
      });
    }

    // résultats de recherche rollover
    if ($('.serp-formation').length) {
      $('.serp-formation .details').hide();
      $('.serp-formation li').hover(
        function() {
          $(this).find('.details').fadeIn();
        },
        function() {
          $(this).find('.details').fadeOut();
        }
      );
    };

  }); // fin DOM ready


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
        icon: '../images/picto/marker_gmap.png'
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

  // formulaires : blocs de choix multiples
  function init_tree ($bloc) {

    var $tree = $bloc.find('.tree');
    var $c_filtre = $bloc.find('.form-filtre input');
    var $bt_filter = $bloc.find('.bt-filter');
    var $bt_del_filter = $bloc.find('.del-filter');
    var filtered_data = {};

    $tree.dynatree({
      checkbox: true,
      selectMode: 3,
      noLink: true,
      onSelect: function(select, node) {
        var this_dynatree = this;
        var selNodes = node.tree.getSelectedNodes();
        // affiche les choix dans la colonne de droite
        var $listing = this_dynatree['$tree'].parent().next('.col-choix-actifs').find('.choix-actifs');
        var html_listing = '';
        $.each(selNodes, function(index, value){
          html_listing += '<div class="choix-actif"><a title="Supprimer" class="del-choice" href="#_" data-target="' + value.data.key + '"></a> ' +  value.data.title + '</div>';
        });
        if (html_listing == '') {
          html_listing = '<p>Faites vos choix dans la colonne de gauche</p>';
        }
        $listing.html(html_listing);
        $listing.find('.del-choice').unbind('click');
        $listing.find('.del-choice').on('click', function(e){
          e.preventDefault();
          var $this = $(this);
          this_dynatree.getNodeByKey($this.data('target')).toggleSelect();
        });
      },
      onPostInit: function(isReloading, isError) {
        // création d'un JSON exploitable pour le autocomplete du filtre
        var json_autocomplete = [];
        populate_json(json_autocomplete, this.tnRoot);

        $c_filtre.autocomplete({
          source: json_autocomplete,
          select: function( event, ui ) {

            // annule le filtre précédent
            $tree.find('li').removeClass('filtered');
            $tree.find('li').removeClass('hidden');

            if (!$tree.dynatree("getTree").getNodeByKey(ui.item.value).isSelected()) {
              // coche et déroule le choix dans l'arbo
              if (!$tree.dynatree("getTree").getNodeByKey(ui.item.value).isSelected()) {
                $tree.dynatree("getTree").getNodeByKey(ui.item.value).toggleSelect();
                $tree.dynatree("getTree").activateKey(ui.item.value);
              };
            };

            // vide le champ de recherche
            setTimeout(function() {
              $c_filtre.val('');
            }, 1);


          },
          focus: function (event, ui) {
            event.preventDefault();
          },
          response: function (event, ui) {
            filtered_data = ui.content;
          }
        });
        $c_filtre.on('keypress', function(e){
          if (e.keyCode == 13) {
            // n'envoie pas le formulaire si on appuie sur Entrée
            e.preventDefault();
            $bt_filter.trigger('click');
          }
        });
      }
    });

    $bt_filter.on('click', function () {
      // annule le filtre précédent
      $tree.find('li').removeClass('filtered');
      $tree.find('li').removeClass('hidden');

      if (filtered_data.length) {

        // pour chaque élément trouvé
        for (var i in filtered_data) {
          var none_id = filtered_data[i].value;

          // déroule l'arbo pour voir le node
          $tree.dynatree("getTree").activateKey(none_id);

          // ajoute un classe 'filtered' sur le node filtré
          $($tree.dynatree("getTree").getNodeByKey(none_id).li).addClass('filtered');

          // ... et ses parents
          $tree.dynatree("getTree").getNodeByKey(none_id).visitParents(function (node) {
            $(node.li).addClass('filtered');
          });
        }

        // masque tous les nodes non filtrés
        $tree.find('li:not(.filtered)').addClass('hidden');

      };

      $c_filtre.trigger('blur');
      $bt_del_filter.show();

    });

    $bt_del_filter.on('click', function () {
      // annule le filtre précédent
      $tree.find('li').removeClass('filtered');
      $tree.find('li').removeClass('hidden');

      $c_filtre.val('');
      $bt_del_filter.hide();

    });
  }

  function populate_json (json, data) {
    if (data.childList) {
      for (var i = 0; i < data.childList.length; i++) {
        json.push({
          value: data.childList[i].data.key,
          label: data.childList[i].data.title
        });
        if (typeof(data.childList[i].childList) != 'null') {
          populate_json(json, data.childList[i]);
        }
      };
    }
  }

})($j);
