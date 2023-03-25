<?php

if (!function_exists('uom_converter')) {
    /**
     * convert between 2 UOMs.
     *
     * @param  mixed  $from
     * @param  mixed  $to
     * @param  string $value
     * @return float
     */
    function uom_converter($from, $to, $value)
    {
        if ($from == $to) {
            return $value;
        }

        if ($from == 'g' && $to == 'kg') {
            return $value / 1000;
        }

        if ($from == 'kg' && $to == 'g') {
            return $value * 1000;
        }
    }
}