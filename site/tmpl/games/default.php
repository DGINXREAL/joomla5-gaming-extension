<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

/** @var \DGInxreal\Component\Games\Site\View\Games\HtmlView $this */
?>

<div class="com-games games-list">
    <h1><?php echo Text::_('COM_GAMES_GAMES_LIST'); ?></h1>

    <?php if (empty($this->items)) : ?>
        <p><?php echo Text::_('COM_GAMES_NO_GAMES'); ?></p>
    <?php else : ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($this->items as $item) : ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $this->escape($item->name); ?></h5>
                            <?php if ($item->release_date) : ?>
                                <p class="card-text text-muted">
                                    <small><?php echo Text::_('COM_GAMES_FIELD_RELEASE_DATE_LABEL'); ?>: <?php echo HTMLHelper::_('date', $item->release_date, Text::_('DATE_FORMAT_LC4')); ?></small>
                                </p>
                            <?php endif; ?>
                            <div class="card-text"><?php echo $item->description; ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php echo $this->pagination->getListFooter(); ?>
    <?php endif; ?>
</div>
