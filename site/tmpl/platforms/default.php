<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \DGInxreal\Component\Games\Site\View\Platforms\HtmlView $this */
?>

<div class="com-games platforms-list">
    <h1><?php echo Text::_('COM_GAMES_PLATFORMS_LIST'); ?></h1>

    <?php if (empty($this->items)) : ?>
        <p><?php echo Text::_('COM_GAMES_NO_PLATFORMS'); ?></p>
    <?php else : ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($this->items as $item) : ?>
                <div class="col">
                    <div class="card h-100">
                        <?php if (!empty($item->image_id)) : ?>
                            <img src="<?php echo $this->escape($item->image_id); ?>" class="card-img-top" alt="<?php echo $this->escape($item->name); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php echo Route::_('index.php?option=com_games&view=platform&slug=' . $item->slug); ?>">
                                    <?php echo $this->escape($item->name); ?>
                                </a>
                                <?php if (!empty($item->abbreviation)) : ?>
                                    <small class="text-muted">(<?php echo $this->escape($item->abbreviation); ?>)</small>
                                <?php endif; ?>
                            </h5>
                            <?php if (!empty($item->company_name)) : ?>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <a href="<?php echo Route::_('index.php?option=com_games&view=company&slug=' . $item->company_slug); ?>">
                                            <?php echo $this->escape($item->company_name); ?>
                                        </a>
                                    </small>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($item->deck)) : ?>
                                <p class="card-text"><?php echo $this->escape($item->deck); ?></p>
                            <?php endif; ?>
                            <?php if ($item->released_at) : ?>
                                <p class="card-text text-muted">
                                    <small><?php echo Text::_('COM_GAMES_FIELD_RELEASED_AT_LABEL'); ?>: <?php echo HTMLHelper::_('date', $item->released_at, Text::_('DATE_FORMAT_LC4')); ?></small>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
