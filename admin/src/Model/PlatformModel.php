<?php

namespace DGInxreal\Component\Games\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Form\Form;

class PlatformModel extends AdminModel
{
    public $typeAlias = 'com_games.platform';

    public function getForm($data = [], $loadData = true): Form|false
    {
        $form = $this->loadForm('com_games.platform', 'platform', ['control' => 'jform', 'load_data' => $loadData]);

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = \Joomla\CMS\Factory::getApplication()->getUserState('com_games.edit.platform.data', []);

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function getTable($name = 'Platform', $prefix = 'Administrator', $options = [])
    {
        return parent::getTable($name, $prefix, $options);
    }
}
