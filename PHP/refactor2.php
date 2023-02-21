<?php

function getMarketplacesStatuses()
{
    $result = [];

    $marketplaces = ['type' => 'ebay', 'status' => 'error'];

    $status = [
        'active' => 'active',
        'error' => 'error',
        'in_progress' => 'error',
    ];

    foreach ($marketplaces as $marketplace) {
        //* check to see if the key is in any array else set default value to queue
        $marketplace['status'] = array_key_exists($marketplace['status'], $status) ? $status[$marketplace['status']] : 'queue';
        $result[$marketplace['marketplace_type']] = $marketplace;
    }

    return $result;
}

/*
TASK 2: Refactor Code:

function getMarketplacesStatuses() {
  $result = [];

  // example $marketplace = ['type' => 'ebay', 'status' => 'error']
   
  foreach ($marketplaces as $marketplace) {
    $status = null;

    if ($marketplace['status'] == 'active') {
        $status = 'active';
    } elseif ($marketplace['status'] == 'error' || $marketplace['status'] == 'in_progress') {
        $status = 'error';
    } else {
        $status = 'queue';
    }

    $marketplace['status']                    = $status;
    $result[$marketplace['marketplace_type']] = $marketplace;
}

return $result;
}

*/