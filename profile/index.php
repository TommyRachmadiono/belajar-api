<?php 

function curl_API($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($curl);

  curl_close($curl);

  return json_decode($result, true);
}

//Youtube Channel Data
$result = curl_API('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCoz3Kpu5lv-ALhR4h9bDvcw&key=AIzaSyBSaASWQak1z71PQN85Pd67zuMMYCCsBBU');

$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscribers = $result['items'][0]['statistics']['subscriberCount'];

//Latest Video
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyBSaASWQak1z71PQN85Pd67zuMMYCCsBBU&channelId=UCoz3Kpu5lv-ALhR4h9bDvcw&maxResults=1&order=date&part=snippet';
$result = curl_API($urlLatestVideo);

$latestVideo = $result['items'][0]['id']['videoId'];


//Instagram API
//Client ID 4e0eaa11736042079aa202a599060f80
//Access Token 2109939466.4e0eaa1.fa70eb8ebae94198b101bf12fc78a7cd

$result = curl_API('https://api.instagram.com/v1/users/self?access_token=2109939466.4e0eaa1.fa70eb8ebae94198b101bf12fc78a7cd');
$usernameIG = $result['data']['username'];
$profilePicIG = $result['data']['profile_picture'];
$followers = $result['data']['counts']['followed_by'];

//Latest IG Post
$result = curl_API('https://api.instagram.com/v1/users/self/media/recent/?access_token=2109939466.4e0eaa1.fa70eb8ebae94198b101bf12fc78a7cd&count=6');

$photos = [];

foreach ($result['data'] as $photo) {
  $photos[] = $photo['images']['thumbnail']['url'];
}

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  <!-- My CSS -->
  <link rel="stylesheet" href="css/style.css">

  <title>My Portfolio</title>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand scroll" href="#home">Tommy Rachmadiono</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item scroll">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link scroll" href="#about">About</a>
          </li>
          <li class="nav-item scroll">
            <a class="nav-link" href="#social-media">Social Media</a>
          </li>
          <li class="nav-item">
            <a class="nav-link scroll" href="#portfolio">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link scroll" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="jumbotron" id="home">
    <div class="container">
      <div class="text-center">
        <img src="img/profile1.png" class="rounded-circle img-thumbnail">
        <h1 class="display-4">Tommy Rachmadiono W.S</h1>
        <h3 class="lead">Freelancer | Programmer | Gamer</h3>
      </div>
    </div>
  </div>


  <!-- About -->
  <section class="about" id="about">
    <div class="container">
      <div class="row mb-4">
        <div class="col text-center">
          <h2>About</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-5">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, molestiae sunt doloribus error ullam expedita cumque blanditiis quas vero, qui, consectetur modi possimus. Consequuntur optio ad quae possimus, debitis earum.</p>
        </div>
        <div class="col-md-5">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, molestiae sunt doloribus error ullam expedita cumque blanditiis quas vero, qui, consectetur modi possimus. Consequuntur optio ad quae possimus, debitis earum.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Social Media -->
  <section class="social-media bg-light" id="social-media">
    <div class="container">
      <div class="row pt-4 mb-4">
        <div class="col text-center">
          <h2>Social Media</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src="<?php echo $youtubeProfilePic ?>" alt="" width="200" class="rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5><?php echo $channelName; ?></h5>
              <p><?php echo $subscribers; ?>Subscribers</p>
              <div class="g-ytsubscribe" data-channelid="UCoz3Kpu5lv-ALhR4h9bDvcw" data-layout="default" data-count="default"></div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $latestVideo; ?>?rel=0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src="<?php echo $profilePicIG; ?>" alt="" width="200" class="rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5><?php echo $usernameIG; ?></h5>
              <p><?php echo $followers ?> Followers</p>
            </div>
          </div>

          <div class="row mt-3 pb-3">
            <div class="col">

              <?php foreach ($photos as $photo) { ?>
                <div class="ig-thumbnails mb-4 ml-3">
                  <img src="<?php echo $photo; ?>" alt="">
                </div>
              <?php } ?>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio -->
  <section class="portfolio " id="portfolio">
    <div class="container">
      <div class="row pt-4 mb-4">
        <div class="col text-center">
          <h2>Portfolio</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/1.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>

        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/2.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>

        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/3.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>   
      </div>

      <div class="row">
        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/4.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div> 
        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/5.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md mb-4">
          <div class="card">
            <img class="card-img-top" src="img/thumbs/6.png" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Contact -->
  <section class="contact bg-light" id="contact">
    <div class="container">
      <div class="row pt-4 mb-4">
        <div class="col text-center">
          <h2>Contact</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-4">
          <div class="card bg-primary text-white mb-4 text-center">
            <div class="card-body">
              <h5 class="card-title">Contact Me</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>

          <ul class="list-group mb-4">
            <li class="list-group-item"><h3>Location</h3></li>
            <li class="list-group-item">My Office</li>
            <li class="list-group-item">Jl. Setiabudhi No. 193, Bandung</li>
            <li class="list-group-item">West Java, Indonesia</li>
          </ul>
        </div>

        <div class="col-lg-6">

          <form>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="text" class="form-control" id="phone">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control" id="message" rows="3"></textarea>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-primary">Send Message</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </section>


  <!-- footer -->
  <footer class="bg-dark text-white mt-5">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <p>Copyright &copy; 2018.</p>
        </div>
      </div>
    </div>
  </footer>







  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"
  ></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  
  <script src="https://apis.google.com/js/platform.js"></script>

  <script src="js/script.js"></script>
</body>
</html>