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

    public function searchPlatforms()
    {
        $app  = Factory::getApplication();
        $term = $app->getInput()->getString('term', '');

        $db    = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true);

        $query->select('id, name')
            ->from($db->quoteName('#__game_platforms'))
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

    public function getDlcs()
    {
        $app    = Factory::getApplication();
        $gameId = $app->getInput()->getInt('game_id', 0);

        $db    = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true);

        $query->select('d.*, p.name AS platform_name')
            ->from($db->quoteName('#__game_dlcs', 'd'))
            ->join('LEFT', $db->quoteName('#__game_platforms', 'p') . ' ON p.id = d.platform_id')
            ->where($db->quoteName('d.game_id') . ' = :gameId')
            ->bind(':gameId', $gameId, ParameterType::INTEGER)
            ->order('d.name ASC');

        $db->setQuery($query);
        $results = $db->loadObjectList();

        echo new JsonResponse($results);
        $app->close();
    }

    public function saveDlc()
    {
        $app = Factory::getApplication();

        $data = $app->getInput()->get('dlc', [], 'array');

        $db    = Factory::getContainer()->get('DatabaseDriver');
        $table = new \DGInxreal\Component\Games\Administrator\Table\DlcTable($db);

        if (!empty($data['id'])) {
            $table->load((int) $data['id']);
        }

        $table->bind($data);

        if (!$table->check() || !$table->store()) {
            echo new JsonResponse(null, $table->getError(), true);
            $app->close();
        }

        echo new JsonResponse(['id' => $table->id]);
        $app->close();
    }

    public function deleteDlc()
    {
        $app = Factory::getApplication();

        $id = $app->getInput()->getInt('id', 0);

        $db    = Factory::getContainer()->get('DatabaseDriver');
        $table = new \DGInxreal\Component\Games\Administrator\Table\DlcTable($db);

        if (!$table->delete($id)) {
            echo new JsonResponse(null, 'Delete failed', true);
            $app->close();
        }

        echo new JsonResponse(true);
        $app->close();
    }
}
