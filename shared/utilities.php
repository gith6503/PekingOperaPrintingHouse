<?php
class Utilities {

    public function getPaging($page, $total_rows, $records_per_page, $page_url, $range = 2) {
        // Paging array to hold pagination info
        $paging_arr = array();

        // First page link
        $paging_arr["first"] = $page > 1 ? "{$page_url}page=1" : "";

        // Calculate total pages
        $total_pages = ceil($total_rows / $records_per_page);

        // Range of links to display around current page
        $initial_num = $page - $range;
        $end_num = $page + $range;

        $paging_arr['pages'] = array();
        $page_count = 0;

        for ($x = $initial_num; $x <= $end_num; $x++) {
            // Ensure links only for valid pages
            if ($x > 0 && $x <= $total_pages) {
                $paging_arr['pages'][$page_count] = array(
                    "page" => $x,
                    "url" => "{$page_url}page={$x}",
                    "current_page" => $x == $page ? "yes" : "no"
                );
                $page_count++;
            }
        }

        // Last page link
        $paging_arr["last"] = $page < $total_pages ? "{$page_url}page={$total_pages}" : "";

        // Return pagination array in JSON-ready format
        return $paging_arr;
    }

}
?>
