<?php

namespace DGInxreal\Component\Games\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class GameTable extends Table
{
    public function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__games', 'id', $db);
    }

    public function check(): bool
    {
        if (empty($this->name)) {
            $this->setError('Name is required.');
            return false;
        }

        if (empty($this->slug)) {
            $this->slug = $this->name;
        }

        $this->slug = \Joomla\CMS\Filter\OutputFilter::stringURLSafe($this->slug);

        return true;
    }
}
