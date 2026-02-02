<?php

namespace DGInxreal\Component\Games\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;

class CompanyModel extends ItemModel
{
    public function getItem($pk = null)
    {
        $app  = Factory::getApplication();
        $slug = $app->getInput()->getString('slug', '');

        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('a.*')
            ->from($db->quoteName('#__game_companies', 'a'))
            ->where($db->quoteName('a.slug') . ' = :slug')
            ->where($db->quoteName('a.state') . ' = 1')
            ->bind(':slug', $slug);

        $db->setQuery($query);

        return $db->loadObject();
    }
}
