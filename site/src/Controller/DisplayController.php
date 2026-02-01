<?php

namespace DGInxreal\Component\Games\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
    protected $default_view = 'games';

    public function display($cachable = false, $urlparams = []): BaseController
    {
        return parent::display($cachable, $urlparams);
    }
}
