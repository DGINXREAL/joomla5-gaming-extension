<?php

namespace DGInxreal\Component\Games\Site\View\Dlc;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    public $item;

    public function display($tpl = null): void
    {
        $this->item = $this->get('Item');

        if (!$this->item) {
            throw new \Exception('DLC not found', 404);
        }

        parent::display($tpl);
    }
}
