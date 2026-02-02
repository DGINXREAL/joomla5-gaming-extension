<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \DGInxreal\Component\Games\Site\View\Companies\HtmlView $this */
?>

<div class="com-games companies-list">
    <h1><?php echo Text::_('COM_GAMES_COMPANIES_LIST'); ?></h1>

    <?php if (empty($this->items)) : ?>
        <p><?php echo Text::_('COM_GAMES_NO_COMPANIES'); ?></p>
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
                                <a href="<?php echo Route::_('index.php?option=com_games&view=company&slug=' . $item->slug); ?>">
                                    <?php echo $this->escape($item->name); ?>
                                </a>
                                <?php if (!empty($item->abbreviation)) : ?>
                                    <small class="text-muted">(<?php echo $this->escape($item->abbreviation); ?>)</small>
                                <?php endif; ?>
                            </h5>
                            <?php if (!empty($item->deck)) : ?>
                                <p class="card-text"><?php echo $this->escape($item->deck); ?></p>
                            <?php endif; ?>
                            <?php if ($item->founded_at) : ?>
                                <p class="card-text text-muted">
                                    <small><?php echo Text::_('COM_GAMES_FIELD_FOUNDED_AT_LABEL'); ?>: <?php echo HTMLHelper::_('date', $item->founded_at, Text::_('DATE_FORMAT_LC4')); ?></small>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
