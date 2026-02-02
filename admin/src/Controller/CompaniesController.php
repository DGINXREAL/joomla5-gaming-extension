<?php

namespace DGInxreal\Component\Games\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class CompaniesController extends AdminController
{
    public function getModel($name = 'Company', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }
}
