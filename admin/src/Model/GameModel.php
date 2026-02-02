<?php

namespace DGInxreal\Component\Games\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Factory;
use Joomla\Database\ParameterType;

class GameModel extends AdminModel
{
    public $typeAlias = 'com_games.game';

    public function getForm($data = [], $loadData = true): Form|false
    {
        $form = $this->loadForm('com_games.game', 'game', ['control' => 'jform', 'load_data' => $loadData]);

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = Factory::getApplication()->getUserState('com_games.edit.game.data', []);

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);

        if ($item && $item->id) {
            $db = $this->getDatabase();

            $query = $db->getQuery(true)
                ->select($db->quoteName('company_id'))
                ->from($db->quoteName('#__game_developers'))
                ->where($db->quoteName('game_id') . ' = :gameId')
                ->bind(':gameId', $item->id, ParameterType::INTEGER);
            $db->setQuery($query);
            $item->developers = $db->loadColumn();

            $query = $db->getQuery(true)
                ->select($db->quoteName('company_id'))
                ->from($db->quoteName('#__game_publishers'))
                ->where($db->quoteName('game_id') . ' = :gameId')
                ->bind(':gameId', $item->id, ParameterType::INTEGER);
            $db->setQuery($query);
            $item->publishers = $db->loadColumn();
        }

        return $item;
    }

    public function getTable($name = 'Game', $prefix = 'Administrator', $options = [])
    {
        return parent::getTable($name, $prefix, $options);
    }

    public function save($data): bool
    {
        $developers = $data['developers'] ?? [];
        $publishers = $data['publishers'] ?? [];

        unset($data['developers'], $data['publishers']);

        if (!parent::save($data)) {
            return false;
        }

        $gameId = (int) $this->getState($this->getName() . '.id');
        $db     = $this->getDatabase();

        $this->saveRelation($db, '#__game_developers', $gameId, $developers);
        $this->saveRelation($db, '#__game_publishers', $gameId, $publishers);

        return true;
    }

    private function saveRelation($db, string $table, int $gameId, array $companyIds): void
    {
        $query = $db->getQuery(true)
            ->delete($db->quoteName($table))
            ->where($db->quoteName('game_id') . ' = :gameId')
            ->bind(':gameId', $gameId, ParameterType::INTEGER);
        $db->setQuery($query);
        $db->execute();

        foreach ($companyIds as $companyId) {
            $companyId = (int) $companyId;
            if ($companyId > 0) {
                $obj = (object) ['game_id' => $gameId, 'company_id' => $companyId];
                $db->insertObject($table, $obj);
            }
        }
    }
}
