<?php
    $base64_image = base64_encode(file_get_contents("map.png"));
    $base64_script = base64_encode(file_get_contents("jquery.js"));
    echo '<script src="data:text/javascript;base64,'.$base64_script.'"></script>';
    echo '<img src="data:image/png;base64,'.$base64_image.'">';
?>