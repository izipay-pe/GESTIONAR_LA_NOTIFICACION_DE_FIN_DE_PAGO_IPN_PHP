<?php
// IPN del formulario API V1, V2 y API REST respectvamente"
if( isset($_POST["vads_hash"]) || isset($_POST["kr-hash"]) ){
    file_put_contents("respuestasIPN/notificacionIPN-".time(),json_encode($_POST));
}