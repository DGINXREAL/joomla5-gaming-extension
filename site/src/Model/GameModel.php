<?php

namespace DGInxreal\Component\Games\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;
use Joomla\Database\ParameterType;

class GameModel extends ItemModel
{
    public function getItem($pk = null)
    {
        $app  = Factory::getApplication();
        $slug = $app->getInput()->getString('slug', '');

        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('a.*')
            ->from($db->quoteName('#__games', 'a'))
            ->where($db->quoteName('a.slug') . ' = :slug')
            ->where($db->quoteName('a.state') . ' = 1')
            ->bind(':slug', $slug);

        $db->setQuery($query);
        $item = $db->loadObject();

        if ($item) {
            $item->developers = $this->loadRelatedCompanies($db, '#__game_developers', (int) $item->id);
            $item->publishers = $this->loadRelatedCompanies($db, '#__game_publishers', (int) $item->id);
        }

        return $item;
    }

    private function loadRelatedCompanies($db, string $table, int $gameId): array
    {
        $query = $db->getQuery(true)
            ->select('c.id, c.name, c.slug')
            ->from($db->quoteName($table, 'r'))
            ->join('INNER', $db->quoteName('#__game_companies', 'c') . ' ON c.id = r.company_id')
            ->where($db->quoteName('r.game_id') . ' = :gameId')
            ->where($db->quoteName('c.state') . ' = 1')
            ->bind(':gameId', $gameId, ParameterType::INTEGER)
            ->order('c.name ASC');

        $db->setQuery($query);

        return $db->loadObjectList() ?: [];
    }
}
