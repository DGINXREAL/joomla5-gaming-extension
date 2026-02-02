<?php

namespace DGInxreal\Component\Games\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class PlatformsController extends AdminController
{
    public function getModel($name = 'Platform', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }
}
