<?php

namespace DGInxreal\Component\Games\Site\View\Platform;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{
    protected $item;

    public function display($tpl = null): void
    {
        $this->item = $this->get('Item');

        if (empty($this->item)) {
            throw new \Exception(Text::_('JGLOBAL_RESOURCE_NOT_FOUND'), 404);
        }

        parent::display($tpl);
    }
}
