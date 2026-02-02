<?php

namespace DGInxreal\Component\Games\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;

class DlcModel extends ItemModel
{
    public function getItem($pk = null)
    {
        $app  = Factory::getApplication();
        $slug = $app->getInput()->getString('slug', '');

        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('a.*')
            ->select($db->quoteName('g.name', 'game_name'))
            ->select($db->quoteName('g.slug', 'game_slug'))
            ->select($db->quoteName('p.name', 'platform_name'))
            ->select($db->quoteName('p.slug', 'platform_slug'))
            ->from($db->quoteName('#__game_dlcs', 'a'))
            ->join('INNER', $db->quoteName('#__games', 'g') . ' ON g.id = a.game_id')
            ->join('LEFT', $db->quoteName('#__game_platforms', 'p') . ' ON p.id = a.platform_id')
            ->where($db->quoteName('a.slug') . ' = :slug')
            ->where($db->quoteName('a.state') . ' = 1')
            ->bind(':slug', $slug);

        $db->setQuery($query);

        return $db->loadObject();
    }
}
