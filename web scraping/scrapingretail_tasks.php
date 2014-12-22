<?php class ScrapingRetail_Task {
    public function run($arguments)
    {
        $actions = ActionRetail::all();

        foreach ( $actions as $action) {
            if (!$action->doAction()) {
                Log::error(__FILE__, __LINE__, $arguments);
            }
        }
        echo "End ScrapingRetail $arguments.";
    }
}
?>