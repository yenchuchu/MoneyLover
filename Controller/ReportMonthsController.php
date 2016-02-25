<?php

App::uses('AppController', 'Controller');

/**
 * Report Month Controller
 *
 * @property Transaction $Transaction
 * @property PaginatorComponent $Paginator
 */
class ReportMonthsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->set('showLayoutContent', true);
    }

}
