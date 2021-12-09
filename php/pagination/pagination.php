<?php

include "../conecao/conecao.php";

function get_total_row($conn)
{
    $result = $conn->query("SELECT * FROM filmes");
    $num_rows = mysqli_num_rows($result);
    return $num_rows;
}

$total_record = get_total_row($conn);
$limit = '32';
$page = 1;
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    //$start = 0;
}

$query = "SELECT * FROM filmes";

if ($_POST['query'] != '') {
    $query .= '
  WHERE name LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%" 
  ';
}

$filter_query = $query . ' LIMIT ' . $limit . '';
$result2 = $conn->query($query);
$total_data = mysqli_num_rows($result2);
$statement = $conn->query($filter_query);

$total_filter_data = mysqli_num_rows($statement);

if ($total_data > 0) {$output="";
    while ($row = mysqli_fetch_assoc($statement)) {

        $output .= '
        <a href="movie.php?title=' . $row['name'] . '" class="item tilt-poster">
            <div class="poster" style="background-image: url(img_uploads/' . $row['image'] . '.jpg)">
            </div>
            <?php <p>' . $row['name'] . '</p>
            </a>
    
';
    }
}
$output .= '
<div align="center">
  <ul class="pagination">
';
$total_links = ceil($total_data / $limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if ($total_links > 4) {
    if ($page < 6) {
        for ($count = 1; $count <= 6; $count++) {
            $page_array[] = $count;
        }
        $page_array[] = '...';
        $page_array[] = $total_links;
    } else {
        $end_limit = $total_links - 6;
        if ($page > $end_limit) {
            $page_array[] = 1;
            $page_array[] = '...';
            for ($count = $end_limit; $count <= $total_links; $count++) {
                $page_array[] = $count;
            }
        } else {
            $page_array[] = 1;
            $page_array[] = '...';
            for ($count = $page - 1; $count <= $page + 1; $count++) {
                $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        }
    }
} else {
    for ($count = 1; $count <= $total_links; $count++) {
        $page_array[] = $count;
    }
}
if (!$total_data == 0) {
    for ($count = 0; $count < count($page_array); $count++) {
        if ($page == $page_array[$count]) {
            $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
    </li>
    ';

            $previous_id = $page_array[$count] - 1;
            if ($previous_id > 0) {
                $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">«</a></li>';
            } else {
                $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">«</a>
      </li>
      ';
            }
            $next_id = $page_array[$count] + 1;
            if ($next_id > $total_links) {
                $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">»</a>
      </li>
        ';
            } else {
                $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">»</a></li>';
            }
        } else {
            if ($page_array[$count] == '...') {
                $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
            } else {
                $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
      ';
            }
        }
    }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;
