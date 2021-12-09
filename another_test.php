<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="css/index/style.css">
    <link rel="stylesheet" href="css/index/navbar.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="pagination.css">
    <link rel="stylesheet" href="/lib/bootstrap.min.css">

    <!-- js -->
    <script src="js/index/script.js"></script>
</head>

<body>
    <header>
        <form id="form">
            <input type="text" id="search" placeholder="Search" class="search" />
        </form>
    </header>
    <main id="main"></main>
    <!-- movies details -->
    <script>
        var teste;
        for (i = 1; i <= 500; i++) {
            const APIURL =
                "https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=04c35731a5ee918f014970082a0088b1&page="+i;
            const IMGPATH = "https://image.tmdb.org/t/p/w1280";

            const main = document.getElementById("main");
            const form = document.getElementById("form");
            const search = document.getElementById("search");

            // initially get fav movies
            getMovies(APIURL);

            async function getMovies(url) {
                const resp = await fetch(url);
                const respData = await resp.json();

                console.log(respData);
                teste = respData;
                showMovies(respData.results);
            }

            function showMovies(movies) {
                // clear main
                main.innerHTML = "";
                fodase();
                movies.forEach((movie) => {
                    const {
                        poster_path,
                        title,
                        vote_average,
                        overview
                    } = movie;

                    const movieEl = document.createElement("div");
                    movieEl.classList.add("movie");

                    movieEl.innerHTML = `
                    <img
                        src="${IMGPATH + poster_path}"
                        alt="${title}"
                    />
                    <div class="movie-info">
                        <h3>${title}</h3>
                        <span class="${getClassByRate(
                            vote_average
                        )}">${vote_average}</span>
                    </div>
                    <div class="overview">
                        <h3>Overview:</h3>
                        ${overview}
                    </div>
                `;

                    main.appendChild(movieEl);
                });
            }

            function getClassByRate(vote) {
                if (vote >= 8) {
                    return "green";
                } else if (vote >= 5) {
                    return "orange";
                } else {
                    return "red";
                }
            }

            function fodase() {
                $.post('teste.php', {
                    arrayfdd: teste
                }, function(response) {
                    console.log(response);
                });
            }
        }
    </script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/gijsroge/tilt.js/38991dd7/dest/tilt.jquery.js"></script>
</body>

</html>