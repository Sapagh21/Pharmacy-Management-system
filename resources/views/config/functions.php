<?php
function NamePage($filepath)
{
    $pagename = pathinfo($filepath)['filename'];
    return ucfirst($pagename);
}
