<?php

$start = "http://codexshaper.com";

function flower_link($url)
{
    $doc = new DOMDocument();
    @$doc->loadHTML(file_get_contents($url));

    $pokemon_xpath = new DOMXPath($doc);

    $pokemon_row = $pokemon_xpath->query('//section[@class="testimonial-area"]');

    // print_r($pokemon_row);

    if ($pokemon_row->length > 0) {

        foreach ($pokemon_row as $row) {

            $images      = $pokemon_xpath->query('//figure[@class="user-img"]/img', $row);
            $figcaptions = $pokemon_xpath->query('//figcaption[@class="testimonial-caption"]/span/img', $row);
            $users       = $pokemon_xpath->query('//div[@class="user-name"]/h2', $row);
            $deginations = $pokemon_xpath->query('//div[@class="title-name"]/p', $row);
            $icons       = $pokemon_xpath->query('//div[@class="star-icon"]/span', $row);
            $reviews     = $pokemon_xpath->query('//div[@class="review-info"]/p', $row);

            // $images      = [];
            // $figcaptions = [];
            // $degination  = [];
            // $userName    = [];
            // $review      = [];
            foreach ($images as $image) {

                $imag[] = $image->getAttribute('src');
            }
            foreach ($figcaptions as $figcaption) {

                $fig[] = $figcaption->getAttribute('src');
            }
            foreach ($users as $user) {
                $userName[] = $user->nodeValue; //the pokemon type
            }

            foreach ($deginations as $degination) {
                $deg[] = $degination->nodeValue; //the pokemon type
            }

            foreach ($reviews as $review) {
                $rev[] = $review->nodeValue;
            }

            $datas[] = ['images' => $imag, ' figcaptions' => $fig, 'user' => $userName, 'des' => $deg, 'review' => $rev];
        }
    }
    return $datas;
}

$alldatas = flower_link($start);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

    <?php foreach ($alldatas as $data) {?>
    <?php for ($i = 0; $i < count($data) - 1; $i++) {?>


     <div class="info">
		 <img src="<?=$data['images'][$i]?>" alt="">
		 <img src="<?=$data['figcaptions'][$i]?>" alt="">
		  <div class="name"><?=$data['user'][$i]?></div>
		  <div class="des"><?=$data['des'][$i]?></div>
		  <p><?=$data['review'][$i]?></p>
     </div>
     <?php }?>
   <?php }?>
</body>
</html>
