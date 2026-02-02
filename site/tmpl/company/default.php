<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \DGInxreal\Component\Games\Site\View\Company\HtmlView $this */

$item = $this->item;
?>

<div class="com-games company-detail">
    <h1><?php echo $this->escape($item->name); ?>
        <?php if (!empty($item->abbreviation)) : ?>
            <small class="text-muted">(<?php echo $this->escape($item->abbreviation); ?>)</small>
        <?php endif; ?>
    </h1>

    <?php if (!empty($item->image_id)) : ?>
        <div class="company-image mb-3">
            <img src="<?php echo $this->escape($item->image_id); ?>" alt="<?php echo $this->escape($item->name); ?>" class="img-fluid rounded">
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-md-6">
            <?php if ($item->founded_at) : ?>
                <p><strong><?php echo Text::_('COM_GAMES_FIELD_FOUNDED_AT_LABEL'); ?>:</strong> <?php echo HTMLHelper::_('date', $item->founded_at, Text::_('DATE_FORMAT_LC4')); ?></p>
            <?php endif; ?>
            <?php if (!empty($item->phone)) : ?>
                <p><strong><?php echo Text::_('COM_GAMES_FIELD_PHONE_LABEL'); ?>:</strong> <?php echo $this->escape($item->phone); ?></p>
            <?php endif; ?>
            <?php if (!empty($item->website)) : ?>
                <p><strong><?php echo Text::_('COM_GAMES_FIELD_WEBSITE_LABEL'); ?>:</strong> <a href="<?php echo $this->escape($item->website); ?>" target="_blank" rel="noopener noreferrer"><?php echo $this->escape($item->website); ?></a></p>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($item->deck)) : ?>
        <div class="lead mb-3"><?php echo $this->escape($item->deck); ?></div>
    <?php endif; ?>

    <?php if (!empty($item->description)) : ?>
        <div class="company-description">
            <?php echo $item->description; ?>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?php echo Route::_('index.php?option=com_games&view=companies'); ?>" class="btn btn-secondary">
            <?php echo Text::_('COM_GAMES_BACK_TO_COMPANIES'); ?>
        </a>
    </div>
</div>
