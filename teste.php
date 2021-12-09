 <?php
 $i = 1;
 $k=1;
 set_time_limit(10020);
        if (isset($_POST['arrayfdd'])) {
            $arrayfdd = $_POST['arrayfdd'];
/*
            for($k=0;$k<=100000000;$k++){
                $genres=$arrayfdd['results'][$k];
                for($l=0;$l<=count($genres['genre_ids'])-1;$l++){
                    var_dump($genres['genre_ids'][$l]);
                    $genres['title'];
                    $genres['genre_ids'][$l];

                    $myFile = "genre_ids.txt";
                    $fh = fopen($myFile, 'a') or die("can't open file");
                    $total="(".'"'.$genres['title'].'"';
                    $total.=",".'"'.$genres['genre_ids'][$l].'"'."),".PHP_EOL;
                    
                    fwrite($fh, $total);
                    fclose($fh);

                }
            }*/

            for ($i = 0; $i <= 10000; $i++) {
                $myFile = "name1.txt";
                $fh = fopen($myFile, 'a') or die("can't open file");
                $total="(".'"'.$arrayfdd['results'][$i]['title'].'"';
                $total.=",".'"'.$arrayfdd['results'][$i]['release_date'].'"';
                $total.=",".'"'.$arrayfdd['results'][$i]['overview'].'"';
                $total.=",".'"'.$arrayfdd['results'][$i]['poster_path'].'"';
                $total.=",".'"'.$arrayfdd['results'][$i]['backdrop_path'].'"';
                $total.=",".'"'.$arrayfdd['results'][$i]['vote_average'].'"'."),".PHP_EOL;
                
                fwrite($fh, $total);
                fclose($fh);
            }

        }
    ?>