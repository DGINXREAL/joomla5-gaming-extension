<?php

namespace DGInxreal\Component\Games\Administrator\Field;

defined('_JEXEC') or die;

use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Factory;

class CompaniesField extends ListField
{
    protected $type = 'Companies';

    protected function getOptions(): array
    {
        $db    = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true);

        $query->select($db->quoteName(['id', 'name']))
            ->from($db->quoteName('#__game_companies'))
            ->where($db->quoteName('state') . ' = 1')
            ->order('name ASC');

        $db->setQuery($query);
        $companies = $db->loadObjectList();

        $options = [];

        foreach ($companies as $company) {
            $options[] = (object) [
                'value' => $company->id,
                'text'  => $company->name,
            ];
        }

        return array_merge(parent::getOptions(), $options);
    }
}
