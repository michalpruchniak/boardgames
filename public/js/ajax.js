
$(function(){

  var gamesLength = 0;
  var publisherLength = 0;
  var designersLength = 0;
  var artistsLength = 0;



  $('#search').on( "keyup", function() {

      $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/ajax/gry",
        data: {
          title: $(this).val()
        },
        success: function(result){
          gamesLength = result.length;
          $('.games .game-list').empty();
          result.forEach(function(value) {
            $('.games .game-list').append('<a href="/gra/' +value.slug+ '" class="game-list__element">' +value.title+ '</a> ');
          });
          if(gamesLength > 0){
            $('.search-result .games').show();
          } else {
            $('.search-result .games').hide();
          }
          if($('.search-result').is(':hidden') && $('#search').val().length >= 2 && (gamesLength > 0 || publisherLength > 0 || designersLength > 0 || designersLength > 0)){
            $('.search-result').show();
          }
          if($('.search-result').is(':visible') && (gamesLength < 1 && publisherLength < 1 && designersLength < 1 && artistsLength < 1 || $('#search').val().length < 2)){
            $('.search-result').hide();
          }
        },
        dataType: 'json'
      });

      $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/ajax/wydawcy",
        data: {
          name: $(this).val()
        },
        success: function(result){
          publisherLength = result.length;
          $('.publishers .publishers-list').empty();
          result.forEach(function(value) {
            $('.publishers .publishers-list').append('<a href="/wydawca/' +value.slug+ '" class="game-list__element">' +value.name+ '</a> ');
          });


          if(publisherLength > 0){
            $('.search-result .publishers').show();
          } else {
            $('.search-result .publishers').hide();
          }
          if($('.search-result').is(':hidden') && $('#search').val().length >= 2 && (gamesLength > 0 || publisherLength > 0 || designersLength > 0 || designersLength > 0)){
            $('.search-result').show();
          }
          if($('.search-result').is(':visible') && (gamesLength < 1 && publisherLength < 1 && designersLength < 1 && artistsLength < 1 || $('#search').val().length < 2)){
            $('.search-result').hide();
          }
        },
        dataType: 'json'
      });


      $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/ajax/projektanci",
        data: {
          name: $(this).val()
        },
        success: function(result){
          designersLength = result.length;
          $('.designers .designers-list').empty();
          result.forEach(function(value) {
            $('.designers .designers-list').append('<a href="/projektant/' +value.slug+ '" class="game-list__element">' +value.name+ '</a> ');
          });

          if(designersLength > 0){
            $('.search-result .designers').show();
          } else {
            $('.search-result .designers').hide();
          }
          if($('.search-result').is(':hidden') && $('#search').val().length >= 2 && (gamesLength > 0 || publisherLength > 0 || designersLength > 0 || designersLength > 0)){
            $('.search-result').show();
          }
          if($('.search-result').is(':visible') && (gamesLength < 1 && publisherLength < 1 && designersLength < 1 && artistsLength < 1 || $('#search').val().length < 2)){
            $('.search-result').hide();
          }
        },
        dataType: 'json'
      });

      $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/ajax/graficy",
        data: {
          name: $(this).val()
        },
        success: function(result){
          artistsLength = result.length;
          $('.artists .artists-list').empty();
          result.forEach(function(value) {
            $('.artists .artists-list').append('<a href="/grafik/' +value.slug+ '" class="game-list__element">' +value.name+ '</a> ');
          });


          if(artistsLength > 0){
            $('.search-result .artists').show();
          } else {
            $('.search-result .artists').hide();
          }
          if($('.search-result').is(':hidden') && $('#search').val().length >= 2 && (gamesLength > 0 || publisherLength > 0 || designersLength > 0)){
            $('.search-result').show();
          }
          if($('.search-result').is(':visible') && (gamesLength < 1 && publisherLength < 1 && designersLength < 1 && artistsLength < 1 || $('#search').val().length < 2)){
            $('.search-result').hide();
          }
        },
        dataType: 'json'
      });




  });




});
