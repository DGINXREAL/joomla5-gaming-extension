<?php

namespace DGInxreal\Component\Games\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;

class PlatformModel extends ItemModel
{
    public function getItem($pk = null)
    {
        $app  = Factory::getApplication();
        $slug = $app->getInput()->getString('slug', '');

        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('a.*')
            ->select($db->quoteName('c.name', 'company_name'))
            ->select($db->quoteName('c.slug', 'company_slug'))
            ->from($db->quoteName('#__game_platforms', 'a'))
            ->join('LEFT', $db->quoteName('#__game_companies', 'c') . ' ON c.id = a.company_id')
            ->where($db->quoteName('a.slug') . ' = :slug')
            ->where($db->quoteName('a.state') . ' = 1')
            ->bind(':slug', $slug);

        $db->setQuery($query);

        return $db->loadObject();
    }
}
