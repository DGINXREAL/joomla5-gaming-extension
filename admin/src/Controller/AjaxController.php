<?php

namespace DGInxreal\Component\Games\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Response\JsonResponse;
use Joomla\Database\ParameterType;

class AjaxController extends BaseController
{
    public function searchCompanies()
    {
        $app  = Factory::getApplication();
        $term = $app->getInput()->getString('term', '');

        $db    = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true);

        $query->select('id, name')
            ->from($db->quoteName('#__game_companies'))
            ->where($db->quoteName('state') . ' = 1')
            ->order('name ASC')
            ->setLimit(20);

        if (!empty($term)) {
            $search = '%' . trim($term) . '%';
            $query->where($db->quoteName('name') . ' LIKE :search')
                ->bind(':search', $search);
        }

        $db->setQuery($query);
        $results = $db->loadObjectList();

        echo new JsonResponse($results);
        $app->close();
    }
}
