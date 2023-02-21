<?php

$sections = $purchase->items->pluck('product.type')->transform(function ($value) {
    return $value === 'electronics' ? $value : 'non-electronics';
})->unique()->toArray();
//* sections will contain a array of unique "product type" values from the "purchase" object, with any non-"electronics" values replaced with the string "non-electronics".

// not tested!



/*
Task1:

// $purchase is an Eloquent model that has item (ie: purchase items) which belong to a product
$sections = [];
foreach ($purchase->items as $item) {
    $section = $item->product->type == 'electronics' ? 'electronics' : 'non-electronics';
    if ( ! in_array($section, $sections)) {
        $sections[] = $section;
    }
}

*/