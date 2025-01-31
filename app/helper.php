<?php

function makeDiscount($price , $discount)
{
    return  $price - ($price * ($discount / 100));
}
function OriginalPrice($discountedPrice, $discount)
{

    return  $discountedPrice / (1 - ($discount / 100));

   
}