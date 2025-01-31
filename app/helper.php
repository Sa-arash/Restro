<?php

function makeDiscount($price , $discount)
{
    return  $price - ($price * ($discount / 100));
}
function OriginalPrice($discountedPrice, $discount)
{

    return  $discountedPrice / (1 - ($discount / 100));
}

function getDiscountPercentage($originalPrice, $discountedPrice): float
{
    // اگر قیمت اولیه صفر باشد، 100% تخفیف در نظر گرفته می‌شود.
    if ($originalPrice <= 0) {
        return 100.0;
    }

    // محاسبه درصد تغییر قیمت
    $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;

    return round($discountPercentage, 2); // گرد کردن به دو رقم اعشار
}