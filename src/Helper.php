<?php

namespace CoreAlg\Helper;

use Carbon\Carbon;

class Helper
{
    /**
     * Get pagination summary based on given inputs
     * @param int $total_item Total item e.g. 100
     * @param int $item_per_page Item per page e.g. 10
     * @param int $current_page Current page e.g. 1
     * @return string e.g. Showing 1 to 10 of 100 records
     */
    public static function paginationSummary(int $total_item, int $item_per_page, int $current_page): string
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

    /**
     * Convert number to word
     * @param int $number Number e.g. 100
     * @return string e.g. One Hundred Taka Only.
     */
    public static function number2word(int $number): string
    {
        $numberToWords = new \NTWIndia\NTWIndia();

        $word = $numberToWords->numToWord($number);

        return "{$word} Taka Only.";
    }

    /**
     * Format amount
     * @param float $amount Amount e.g. 1000
     * @param float $decimals Decimals e.g. 2
     * @param float $decimal_separator Decimal separator e.g. .
     * @param float $thousands_separator Thousands separator e.g. ,
     * @return float e.g. 1,000.00
     */
    public static function formatAmount(
        float $amount,
        ?int $decimals = null,
        ?string $decimal_separator = null,
        ?string $thousands_separator = null
    ): string {

        if (is_null($decimals)) {
            $decimals = session()->get('core_helper.amount_format.decimals', 0);
        }

        if (is_null($decimal_separator)) {
            $decimal_separator = session()->get('core_helper.amount_format.decimal_separator', '.');
        }

        if (is_null($thousands_separator)) {
            $thousands_separator = session()->get('core_helper.amount_format.thousands_separator', ',');
        }

        return number_format($amount, $decimals, $decimal_separator, $thousands_separator);
    }

    /**
     * Format date to your desired format
     * @param string $date Date e.g. 2021-09-27
     * @param string $format Format (optional) e.g. d M, Y
     * @return string e.g. 27 Sep, 2021
     */
    public static function formatDate(string $date, $format = null): string
    {
        if (is_null($format) === true) {
            $format = session()->get('core_helper.date_format', 'Y-m-d');
        }

        return (string) Carbon::parse($date)->format($format);
    }

    /**
     * Get bootstrap alert box
     * @param string $message Message e.g. Operation Succeed!
     * @param string $type Type e.g. success [available type: success, warning, error, info]
     * @param bool $close_button Close button e.g. true/false
     * @return string HTML markup
     */
    public static function message(string $message, string $type = "success", bool $close_button = true): string
    {
        if ($type === "success") {
            $class = "success";
            $icon = "check-circle";
        } elseif ($type === "warning") {
            $class = "warning";
            $icon = "error";
        } elseif ($type === "error") {
            $class = "danger";
            $icon = "error";
        } elseif ($type === "info") {
            $class = "info";
            $icon = "info-circle";
        } else {
            $class = "success";
            $icon = "check-circle";
        }

        if ($close_button === true) {
            $close_button_html = "
                <button type='button' class='btn-close'  data-bs-dismiss='alert' aria-label='Close'></button>
            ";
        } else {
            $close_button_html = "";
        }

        $html = "
            <div class='alert alert-$class alert-dismissible'>
                $message
                $close_button_html
            </div>
        ";

        return $html;
    }
}
