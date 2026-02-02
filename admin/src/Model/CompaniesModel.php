<?php

namespace DGInxreal\Component\Games\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class CompaniesModel extends ListModel
{
    public function __construct($config = [])
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = [
                'id', 'a.id',
                'name', 'a.name',
                'abbreviation', 'a.abbreviation',
                'founded_at', 'a.founded_at',
                'state', 'a.state',
            ];
        }

        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('a.*')
            ->from($db->quoteName('#__game_companies', 'a'));

        $state = $this->getState('filter.state');
        if (is_numeric($state)) {
            $query->where($db->quoteName('a.state') . ' = :state')
                ->bind(':state', $state, \Joomla\Database\ParameterType::INTEGER);
        }

        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = '%' . trim($search) . '%';
            $query->where($db->quoteName('a.name') . ' LIKE :search')
                ->bind(':search', $search);
        }

        $orderCol  = $this->state->get('list.ordering', 'a.name');
        $orderDirn = $this->state->get('list.direction', 'ASC');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }

    protected function populateState($ordering = 'a.name', $direction = 'ASC')
    {
        parent::populateState($ordering, $direction);
    }
}
