<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \DGInxreal\Component\Games\Site\View\Platform\HtmlView $this */

$item = $this->item;
?>

<div class="com-games platform-detail">
    <h1><?php echo $this->escape($item->name); ?>
        <?php if (!empty($item->abbreviation)) : ?>
            <small class="text-muted">(<?php echo $this->escape($item->abbreviation); ?>)</small>
        <?php endif; ?>
    </h1>

    <?php if (!empty($item->image_id)) : ?>
        <div class="platform-image mb-3">
            <img src="<?php echo $this->escape($item->image_id); ?>" alt="<?php echo $this->escape($item->name); ?>" class="img-fluid rounded">
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-md-6">
            <?php if (!empty($item->company_name)) : ?>
                <p><strong><?php echo Text::_('COM_GAMES_FIELD_COMPANY_LABEL'); ?>:</strong>
                    <a href="<?php echo Route::_('index.php?option=com_games&view=company&slug=' . $item->company_slug); ?>">
                        <?php echo $this->escape($item->company_name); ?>
                    </a>
                </p>
            <?php endif; ?>
            <?php if ($item->released_at) : ?>
                <p><strong><?php echo Text::_('COM_GAMES_FIELD_RELEASED_AT_LABEL'); ?>:</strong> <?php echo HTMLHelper::_('date', $item->released_at, Text::_('DATE_FORMAT_LC4')); ?></p>
            <?php endif; ?>
            <?php if ($item->original_price !== null && $item->original_price > 0) : ?>
                <p><strong><?php echo Text::_('COM_GAMES_FIELD_ORIGINAL_PRICE_LABEL'); ?>:</strong> <?php echo number_format((float) $item->original_price, 2); ?></p>
            <?php endif; ?>
            <?php if (!empty($item->install_base)) : ?>
                <p><strong><?php echo Text::_('COM_GAMES_FIELD_INSTALL_BASE_LABEL'); ?>:</strong> <?php echo $this->escape($item->install_base); ?></p>
            <?php endif; ?>
            <p><strong><?php echo Text::_('COM_GAMES_FIELD_ONLINE_SUPPORT_LABEL'); ?>:</strong>
                <?php echo $item->online_support ? Text::_('JYES') : Text::_('JNO'); ?>
            </p>
        </div>
    </div>

    <?php if (!empty($item->deck)) : ?>
        <div class="lead mb-3"><?php echo $this->escape($item->deck); ?></div>
    <?php endif; ?>

    <?php if (!empty($item->description)) : ?>
        <div class="platform-description">
            <?php echo $item->description; ?>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?php echo Route::_('index.php?option=com_games&view=platforms'); ?>" class="btn btn-secondary">
            <?php echo Text::_('COM_GAMES_BACK_TO_PLATFORMS'); ?>
        </a>
    </div>
</div>
