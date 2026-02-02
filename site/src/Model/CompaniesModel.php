<?php

namespace DGInxreal\Component\Games\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class CompaniesModel extends ListModel
{
    protected function getListQuery()
    {
        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('a.*')
            ->from($db->quoteName('#__game_companies', 'a'))
            ->where($db->quoteName('a.state') . ' = 1')
            ->order('a.name ASC');

        return $query;
    }
}
