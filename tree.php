<?php
class tree
{
    public function build($category, $parent = 0)
    {
        $html = "";
        if (isset($category['parent'][$parent])) {
            $html .= "<ul>\n";
            foreach ($category['parent'][$parent] as $catId) {
                if (! isset($category['parent'][$catId])) {
                    $html .= "<li>\n" . $category['category'][$catId]['cat_name'] . '(' . $category['category'][$catId]['items_count'] . ')' . "</li> \n";
                }
                if (isset($category['parent'][$catId])) {
                    $html .= "<li>\n " . $category['category'][$catId]['cat_name'] . '(' . $this->itemsCount($category, $catId) . ')' .  "\n";
                    $html .= $this->build($category, $catId);
                    $html .= "</li> \n";
                }
            }
            $html .= "</ul> \n";
        }
        return $html;
    }

    private function itemsCount($category, $parent = 0){
        $sum = 0;
        if (isset($category['parent'][$parent])) {
            foreach ($category['parent'][$parent] as $catId) {
                if (! isset($category['parent'][$catId])) {
                    $sum += $category['category'][$catId]['items_count'];
                }
                if (isset($category['parent'][$catId])) {
                    $sum += $this->itemsCount($category, $catId);
                }
            }
        }
        return $sum;
    }
}