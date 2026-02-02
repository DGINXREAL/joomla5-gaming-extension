<?php

namespace DGInxreal\Component\Games\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Form\Form;

class CompanyModel extends AdminModel
{
    public $typeAlias = 'com_games.company';

    public function getForm($data = [], $loadData = true): Form|false
    {
        $form = $this->loadForm('com_games.company', 'company', ['control' => 'jform', 'load_data' => $loadData]);

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = \Joomla\CMS\Factory::getApplication()->getUserState('com_games.edit.company.data', []);

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function getTable($name = 'Company', $prefix = 'Administrator', $options = [])
    {
        return parent::getTable($name, $prefix, $options);
    }
}
