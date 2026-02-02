<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \DGInxreal\Component\Games\Administrator\View\Platform\HtmlView $this */

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
?>

<form action="<?php echo Route::_('index.php?option=com_games&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">

    <div class="main-card">
        <div class="row">
            <div class="col-lg-9">
                <?php echo $this->form->renderField('name'); ?>
                <?php echo $this->form->renderField('slug'); ?>
                <?php echo $this->form->renderField('abbreviation'); ?>
                <?php echo $this->form->renderField('company_id'); ?>
                <?php echo $this->form->renderField('released_at'); ?>
                <?php echo $this->form->renderField('original_price'); ?>
                <?php echo $this->form->renderField('install_base'); ?>
                <?php echo $this->form->renderField('image_id'); ?>
                <?php echo $this->form->renderField('deck'); ?>
                <?php echo $this->form->renderField('description'); ?>
            </div>
            <div class="col-lg-3">
                <?php echo $this->form->renderField('state'); ?>
                <?php echo $this->form->renderField('online_support'); ?>
            </div>
        </div>
    </div>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
