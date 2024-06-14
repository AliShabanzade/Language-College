<?php

if (!function_exists('statusLocalisation')) {
    /**
     * set status localisation
     *
     * @param bool $status
     * @param bool $numeric
     * @param bool $reverse
     * @return array
     * @throws Exception
     */
    function statusLocalisation(bool $status, bool $numeric = false, bool $reverse = false): array
    {
        $new_status = $status;

        if ($reverse) {
            $new_status = !$status;
        }

        $value = $numeric ? (int)$new_status : $new_status; // Cast boolean to integer if $numeric is true

        return match ($value) {
            1, true  => [
                'value'   => $numeric ? (int)$status : $status,
                'label'   => __('general.active'),
                'badge'   => '#1FB863',
                'bgColor' => '#EEFBF4',
            ],
            0, false => [
                'value'   => $numeric ? (int)$status : $status,
                'label'   => __('general.inactive'),
                'badge'   => '#FF132F',
                'bgColor' => '#FFE5E8',
            ],
            default  => throw new Exception('Invalid status value')
        };
    }
}
