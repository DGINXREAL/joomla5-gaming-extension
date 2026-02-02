<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

/** @var \DGInxreal\Component\Games\Administrator\View\Platforms\HtmlView $this */

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo Route::_('index.php?option=com_games&view=platforms'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">
                <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>

                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-info">
                        <span class="icon-info-circle" aria-hidden="true"></span>
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="platformsList">
                        <thead>
                            <tr>
                                <td class="w-1 text-center">
                                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                                </td>
                                <th scope="col" class="w-1 text-center">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_GAMES_FIELD_NAME_LABEL', 'a.name', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col" class="w-10">
                                    <?php echo Text::_('COM_GAMES_FIELD_ABBREVIATION_LABEL'); ?>
                                </th>
                                <th scope="col" class="w-15">
                                    <?php echo Text::_('COM_GAMES_FIELD_COMPANY_LABEL'); ?>
                                </th>
                                <th scope="col" class="w-15">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_GAMES_FIELD_RELEASED_AT_LABEL', 'a.released_at', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col" class="w-5 text-center">
                                    <?php echo Text::_('COM_GAMES_FIELD_ONLINE_SUPPORT_LABEL'); ?>
                                </th>
                                <th scope="col" class="w-5">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->items as $i => $item) : ?>
                                <tr class="row<?php echo $i % 2; ?>">
                                    <td class="text-center">
                                        <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo HTMLHelper::_('jgrid.published', $item->state, $i, 'platforms.', true); ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo Route::_('index.php?option=com_games&task=platform.edit&id=' . $item->id); ?>">
                                            <?php echo $this->escape($item->name); ?>
                                        </a>
                                        <div class="small"><?php echo Text::_('COM_GAMES_FIELD_SLUG_LABEL'); ?>: <?php echo $this->escape($item->slug); ?></div>
                                    </td>
                                    <td>
                                        <?php echo $this->escape($item->abbreviation); ?>
                                    </td>
                                    <td>
                                        <?php echo $item->company_name ? $this->escape($item->company_name) : '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo $item->released_at ? HTMLHelper::_('date', $item->released_at, Text::_('DATE_FORMAT_LC4')) : '-'; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($item->online_support) : ?>
                                            <span class="icon-publish" aria-hidden="true"></span>
                                        <?php else : ?>
                                            <span class="icon-unpublish" aria-hidden="true"></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo $item->id; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php echo $this->pagination->getListFooter(); ?>
                <?php endif; ?>

                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
