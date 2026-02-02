<?php

namespace DGInxreal\Component\Games\Administrator\View\Companies;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{
    protected $items;
    protected $pagination;
    protected $state;
    public $filterForm;
    public $activeFilters;

    public function display($tpl = null): void
    {
        $this->items         = $this->get('Items');
        $this->pagination    = $this->get('Pagination');
        $this->state         = $this->get('State');
        $this->filterForm    = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar(): void
    {
        ToolbarHelper::title(Text::_('COM_GAMES_MANAGER_COMPANIES'), 'building');
        ToolbarHelper::addNew('company.add');
        ToolbarHelper::publish('companies.publish', 'JTOOLBAR_PUBLISH', true);
        ToolbarHelper::unpublish('companies.unpublish', 'JTOOLBAR_UNPUBLISH', true);
        ToolbarHelper::deleteList('', 'companies.delete', 'JTOOLBAR_DELETE');
    }
}
