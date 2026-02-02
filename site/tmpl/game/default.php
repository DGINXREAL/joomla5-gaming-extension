<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \DGInxreal\Component\Games\Site\View\Game\HtmlView $this */

$item = $this->item;
?>

<div class="com-games game-detail">
    <?php if ($item->is_approved) : ?>
        <div class="alert alert-success" role="alert">
            <span class="icon-check-circle" aria-hidden="true"></span>
            <?php echo Text::_('COM_GAMES_APPROVED_ALERT'); ?>
        </div>
    <?php endif; ?>

    <h1><?php echo $this->escape($item->name); ?></h1>

    <?php if (!empty($item->image)) : ?>
        <div class="game-image mb-3">
            <img src="<?php echo $this->escape($item->image); ?>" alt="<?php echo $this->escape($item->name); ?>" class="img-fluid rounded">
        </div>
    <?php endif; ?>

    <?php if ($item->release_date) : ?>
        <p class="text-muted">
            <?php echo Text::_('COM_GAMES_FIELD_RELEASE_DATE_LABEL'); ?>: <?php echo HTMLHelper::_('date', $item->release_date, Text::_('DATE_FORMAT_LC4')); ?>
        </p>
    <?php endif; ?>

    <?php if (!empty($item->developers)) : ?>
        <div class="game-developers mb-3">
            <strong><?php echo Text::_('COM_GAMES_FIELD_DEVELOPERS_LABEL'); ?>:</strong>
            <?php foreach ($item->developers as $i => $dev) : ?>
                <?php if ($i > 0) echo ', '; ?>
                <a href="<?php echo Route::_('index.php?option=com_games&view=company&slug=' . $dev->slug); ?>">
                    <?php echo $this->escape($dev->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($item->publishers)) : ?>
        <div class="game-publishers mb-3">
            <strong><?php echo Text::_('COM_GAMES_FIELD_PUBLISHERS_LABEL'); ?>:</strong>
            <?php foreach ($item->publishers as $i => $pub) : ?>
                <?php if ($i > 0) echo ', '; ?>
                <a href="<?php echo Route::_('index.php?option=com_games&view=company&slug=' . $pub->slug); ?>">
                    <?php echo $this->escape($pub->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="game-description">
        <?php echo $item->description; ?>
    </div>

    <div class="mt-4">
        <a href="<?php echo Route::_('index.php?option=com_games&view=games'); ?>" class="btn btn-secondary">
            <?php echo Text::_('COM_GAMES_BACK_TO_LIST'); ?>
        </a>
    </div>
</div>
