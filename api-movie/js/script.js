function searchMovie()
{
  $("#movie-list").html("");
  
  $.ajax({
    url: "http://omdbapi.com",
    type: "get",
    dataType: "json",
    data: {
      apiKey: "c3ab2e34",
      s: $("#search-input").val()
    },
    
    success: function(data) {
      if (data.Response == "True") {
        var movies = data.Search;
        
        console.log(movies);
        $.each(movies, function(i, data) {
          $("#movie-list").append(
            '<div class="col-md-4 mt-2 mb-5 card-group"><div class="card"><img src="'+ data.Poster +'" class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title">'+ data.Title +'</h5><h6 class="card-subtitle- mb-2 text-muted">'+ data.Year +'</h6><a href="#" data-toggle="modal" data-target="#exampleModal" class="card-link see-detail" data-id="'+ data.imdbID +'">See Details</a></div></div></div>'
            );
        });
        $("#search-input").val("");

      } else {
        $("#movie-list").html(
          '<div class="col"><h1 class="text-center">' +
          data.Error +
          "</h1></div>"
          );
      }
    }
  });
}

$("#search-button").on("click", function() {
  searchMovie();
});

$("#search-input").on("keyup", function(e) {
  if(e.keyCode === 13) {
    searchMovie();
  }
});

$(document).on('click', '.see-detail', function() {
    // console.log($(this).data('id'));
    $.ajax({
      url: "http://omdbapi.com",
      type: "get",
      dataType: "json",
      data: {
        apiKey: "c3ab2e34",
        i: $(this).data('id'),
      },

      success: function (data) {
        if (data.Response === "True") {
          
          $(".modal-body").html('<div class="container-fluid"><div class="row"><div class="col-md-4"><img src="'+ data.Poster +'" class="img-fluid"></div><div class="col-md-8"><ul class="list-group"><li class="list-group-item"><h3>'+ data.Title +'</h3></li><li class="list-group-item">Released : '+ data.Released +'</li><li class="list-group-item">Genre : '+ data.Genre +'</li><li class="list-group-item">Director : '+ data.Director +'</li><li class="list-group-item">Actors : '+ data.Actors +'</li></ul></div></div></div></div>')
        }
      }
    });
  });