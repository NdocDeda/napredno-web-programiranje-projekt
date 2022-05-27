<?php

if (!(isset($is_up) && $is_up)) {
    echo 'Došlo je do pogreške / neovlaštenog pristupa';
    exit();
}