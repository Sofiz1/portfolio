<?php
class Controler {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function displaySection($section) {
        $sectionContent = $this->model->getContentBySection($section);
        $this->view->renderSection($sectionContent);
    }
}
?>
