<?php

namespace DGInxreal\Component\Games\Administrator\View\Game;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;
    public $developers = [];
    public $publishers = [];
    public $dlcs = [];
    public $platforms = [];

    public function display($tpl = null): void
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        $db = Factory::getContainer()->get('DatabaseDriver');

        if ($this->item && $this->item->id) {
            $this->developers = $this->loadRelatedCompanies($db, '#__game_developers', (int) $this->item->id);
            $this->publishers = $this->loadRelatedCompanies($db, '#__game_publishers', (int) $this->item->id);
            $this->dlcs = $this->loadDlcs($db, (int) $this->item->id);
        }

        $this->platforms = $this->loadPlatforms($db);

        $this->addToolbar();
        parent::display($tpl);
    }

    private function loadRelatedCompanies($db, string $table, int $gameId): array
    {
        $query = $db->getQuery(true)
            ->select('c.id, c.name')
            ->from($db->quoteName($table, 'r'))
            ->join('INNER', $db->quoteName('#__game_companies', 'c') . ' ON c.id = r.company_id')
            ->where($db->quoteName('r.game_id') . ' = :gameId')
            ->bind(':gameId', $gameId, \Joomla\Database\ParameterType::INTEGER)
            ->order('c.name ASC');

        $db->setQuery($query);

        return $db->loadObjectList() ?: [];
    }

    private function loadDlcs($db, int $gameId): array
    {
        $query = $db->getQuery(true)
            ->select('d.*, p.name AS platform_name')
            ->from($db->quoteName('#__game_dlcs', 'd'))
            ->join('LEFT', $db->quoteName('#__game_platforms', 'p') . ' ON p.id = d.platform_id')
            ->where($db->quoteName('d.game_id') . ' = :gameId')
            ->bind(':gameId', $gameId, \Joomla\Database\ParameterType::INTEGER)
            ->order('d.name ASC');

        $db->setQuery($query);

        return $db->loadObjectList() ?: [];
    }

    private function loadPlatforms($db): array
    {
        $query = $db->getQuery(true)
            ->select('id, name')
            ->from($db->quoteName('#__game_platforms'))
            ->where($db->quoteName('state') . ' = 1')
            ->order('name ASC');

        $db->setQuery($query);

        return $db->loadObjectList() ?: [];
    }

    protected function addToolbar(): void
    {
        Factory::getApplication()->getInput()->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);
        ToolbarHelper::title(Text::_($isNew ? 'COM_GAMES_MANAGER_GAME_NEW' : 'COM_GAMES_MANAGER_GAME_EDIT'), 'gamepad');
        ToolbarHelper::apply('game.apply');
        ToolbarHelper::save('game.save');
        ToolbarHelper::cancel('game.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
}
