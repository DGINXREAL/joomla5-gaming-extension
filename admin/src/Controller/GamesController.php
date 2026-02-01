<?php

namespace DGInxreal\Component\Games\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class GamesController extends AdminController
{
    public function getModel($name = 'Game', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }
}
