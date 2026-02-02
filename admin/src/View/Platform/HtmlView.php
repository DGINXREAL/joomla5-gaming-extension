<?php

namespace DGInxreal\Component\Games\Administrator\View\Platform;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;

    public function display($tpl = null): void
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar(): void
    {
        Factory::getApplication()->getInput()->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);
        ToolbarHelper::title(Text::_($isNew ? 'COM_GAMES_MANAGER_PLATFORM_NEW' : 'COM_GAMES_MANAGER_PLATFORM_EDIT'), 'screen');
        ToolbarHelper::apply('platform.apply');
        ToolbarHelper::save('platform.save');
        ToolbarHelper::cancel('platform.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
}
