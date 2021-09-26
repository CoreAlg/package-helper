<?php

namespace CoreAlg\Helper;

class Helper
{
    public static function getPaginationSummary(int $total_item, int $item_per_page, int $current_page)
    {
        $from = $total_item > 0 ? 1 : 0;
        $to = $total_item;

        if ($total_item > $item_per_page) {
            if ($current_page === 1) {
                $from = 1;
                $to = $item_per_page;
            } else {
                if (($total_item - ($current_page * $item_per_page)) > $item_per_page) {
                    $from = (($current_page - 1) * $item_per_page) + 1;
                    $to = $current_page * $item_per_page;
                } else {
                    $from = (($current_page - 1) * $item_per_page) + 1;
                    $to = min(($current_page * $item_per_page), $total_item);
                }
            }
        }

        return "Showing {$from} to {$to} of {$total_item} records";
    }
}
