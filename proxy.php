<?php
// proxy.php
$id = isset($_GET['id']) ? $_GET['id'] : '17948';
$target = "https://kinoebi.in/index.php?newsid=" . $id;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// Pretend to be a browser to avoid bot detection
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/110.0.0.0 Safari/537.36');

$content = curl_exec($ch);
curl_close($ch);

// Fix relative links (CSS, Images, JS) so they point to Kinoebi instead of your host
$content = str_replace('href="/', 'href="https://kinoebi.in/', $content);
$content = str_replace('src="/', 'src="https://kinoebi.in/', $content);

echo $content;
?>
