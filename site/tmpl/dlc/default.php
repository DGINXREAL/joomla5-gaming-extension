<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \DGInxreal\Component\Games\Site\View\Dlc\HtmlView $this */

$item = $this->item;
?>

<div class="com-games dlc-detail">
    <h1><?php echo $this->escape($item->name); ?></h1>

    <p class="text-muted">
        <?php echo Text::_('COM_GAMES_FIELD_GAME_LABEL'); ?>:
        <a href="<?php echo Route::_('index.php?option=com_games&view=game&slug=' . $item->game_slug); ?>">
            <?php echo $this->escape($item->game_name); ?>
        </a>
    </p>

    <?php if (!empty($item->image_id)) : ?>
        <div class="dlc-image mb-3">
            <img src="<?php echo $this->escape($item->image_id); ?>" alt="<?php echo $this->escape($item->name); ?>" class="img-fluid rounded">
        </div>
    <?php endif; ?>

    <?php if (!empty($item->platform_name)) : ?>
        <p><strong><?php echo Text::_('COM_GAMES_FIELD_PLATFORM_LABEL'); ?>:</strong>
            <a href="<?php echo Route::_('index.php?option=com_games&view=platform&slug=' . $item->platform_slug); ?>">
                <?php echo $this->escape($item->platform_name); ?>
            </a>
        </p>
    <?php endif; ?>

    <?php if ($item->released_at) : ?>
        <p><strong><?php echo Text::_('COM_GAMES_FIELD_RELEASED_AT_LABEL'); ?>:</strong>
            <?php echo HTMLHelper::_('date', $item->released_at, Text::_('DATE_FORMAT_LC4')); ?>
        </p>
    <?php endif; ?>

    <?php if (!empty($item->deck)) : ?>
        <div class="lead mb-3"><?php echo $this->escape($item->deck); ?></div>
    <?php endif; ?>

    <?php if (!empty($item->description)) : ?>
        <div class="dlc-description">
            <?php echo $item->description; ?>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?php echo Route::_('index.php?option=com_games&view=game&slug=' . $item->game_slug); ?>" class="btn btn-secondary">
            <?php echo Text::_('COM_GAMES_BACK_TO_GAME'); ?>
        </a>
    </div>
</div>
