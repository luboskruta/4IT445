<?php

/**
 * Index Controller
 *
 */
class IndexController extends Zend_Controller_Action
{

    /**
     * Uvodni stranka
     *
     */
    public function indexAction()
    {

		$this->view->title = 'Sportify';
    }

}
