<?php

namespace DGInxreal\Component\Games\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class GamesModel extends ListModel
{
    protected function getListQuery()
    {
        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('a.*')
            ->from($db->quoteName('#__games', 'a'))
            ->where($db->quoteName('a.state') . ' = 1')
            ->order($db->quoteName('a.release_date') . ' DESC');

        return $query;
    }
}
