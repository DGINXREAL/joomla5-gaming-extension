<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;

/** @var \DGInxreal\Component\Games\Administrator\View\Game\HtmlView $this */

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');

$developers = $this->developers;
$publishers = $this->publishers;
?>

<form action="<?php echo Route::_('index.php?option=com_games&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">

    <ul class="nav nav-tabs" id="gameTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">
                <?php echo Text::_('COM_GAMES_TAB_DETAILS'); ?>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="developers-tab" data-bs-toggle="tab" data-bs-target="#developers" type="button" role="tab">
                <?php echo Text::_('COM_GAMES_FIELD_DEVELOPERS_LABEL'); ?>
                <span class="badge bg-secondary" id="developers-count"><?php echo count($developers); ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="publishers-tab" data-bs-toggle="tab" data-bs-target="#publishers" type="button" role="tab">
                <?php echo Text::_('COM_GAMES_FIELD_PUBLISHERS_LABEL'); ?>
                <span class="badge bg-secondary" id="publishers-count"><?php echo count($publishers); ?></span>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="gameTabContent">
        <!-- Details Tab -->
        <div class="tab-pane fade show active" id="details" role="tabpanel">
            <div class="main-card p-3">
                <div class="row">
                    <div class="col-lg-9">
                        <?php echo $this->form->renderField('name'); ?>
                        <?php echo $this->form->renderField('slug'); ?>
                        <?php echo $this->form->renderField('release_date'); ?>
                        <?php echo $this->form->renderField('image'); ?>
                        <?php echo $this->form->renderField('description'); ?>
                    </div>
                    <div class="col-lg-3">
                        <?php echo $this->form->renderField('state'); ?>
                        <?php echo $this->form->renderField('is_approved'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Developers Tab -->
        <div class="tab-pane fade" id="developers" role="tabpanel">
            <div class="main-card p-3">
                <div class="row mb-3">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" id="developer-search"
                                   placeholder="<?php echo Text::_('COM_GAMES_SEARCH_COMPANY'); ?>">
                            <button class="btn btn-outline-secondary" type="button" id="developer-search-btn">
                                <span class="icon-search" aria-hidden="true"></span>
                                <?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
                            </button>
                        </div>
                        <div id="developer-results" class="list-group mt-2" style="display:none;"></div>
                    </div>
                </div>
                <table class="table" id="developer-list">
                    <thead>
                        <tr>
                            <th><?php echo Text::_('COM_GAMES_FIELD_NAME_LABEL'); ?></th>
                            <th class="w-10"><?php echo Text::_('JACTION_DELETE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($developers as $dev) : ?>
                            <tr data-id="<?php echo $dev->id; ?>">
                                <td><?php echo $this->escape($dev->name); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger remove-relation" data-type="developers" data-id="<?php echo $dev->id; ?>">
                                        <span class="icon-times" aria-hidden="true"></span>
                                    </button>
                                </td>
                                <input type="hidden" name="jform[developers][]" value="<?php echo $dev->id; ?>">
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Publishers Tab -->
        <div class="tab-pane fade" id="publishers" role="tabpanel">
            <div class="main-card p-3">
                <div class="row mb-3">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" id="publisher-search"
                                   placeholder="<?php echo Text::_('COM_GAMES_SEARCH_COMPANY'); ?>">
                            <button class="btn btn-outline-secondary" type="button" id="publisher-search-btn">
                                <span class="icon-search" aria-hidden="true"></span>
                                <?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
                            </button>
                        </div>
                        <div id="publisher-results" class="list-group mt-2" style="display:none;"></div>
                    </div>
                </div>
                <table class="table" id="publisher-list">
                    <thead>
                        <tr>
                            <th><?php echo Text::_('COM_GAMES_FIELD_NAME_LABEL'); ?></th>
                            <th class="w-10"><?php echo Text::_('JACTION_DELETE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($publishers as $pub) : ?>
                            <tr data-id="<?php echo $pub->id; ?>">
                                <td><?php echo $this->escape($pub->name); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger remove-relation" data-type="publishers" data-id="<?php echo $pub->id; ?>">
                                        <span class="icon-times" aria-hidden="true"></span>
                                    </button>
                                </td>
                                <input type="hidden" name="jform[publishers][]" value="<?php echo $pub->id; ?>">
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = '<?php echo Session::getFormToken(); ?>';
    const searchUrl = '<?php echo Route::_('index.php?option=com_games&task=ajax.searchCompanies&format=json', false); ?>';

    function initRelationTab(type) {
        const searchInput = document.getElementById(type.slice(0, -1) + '-search');
        const searchBtn = document.getElementById(type.slice(0, -1) + '-search-btn');
        const resultsDiv = document.getElementById(type.slice(0, -1) + '-results');
        const tbody = document.querySelector('#' + type.slice(0, -1) + '-list tbody');
        const countBadge = document.getElementById(type + '-count');

        function updateCount() {
            countBadge.textContent = tbody.querySelectorAll('tr').length;
        }

        function doSearch() {
            const term = searchInput.value.trim();
            if (term.length < 1) return;

            fetch(searchUrl + '&term=' + encodeURIComponent(term) + '&' + token + '=1')
                .then(r => r.json())
                .then(response => {
                    const data = response.data || [];
                    resultsDiv.innerHTML = '';
                    resultsDiv.style.display = data.length ? 'block' : 'none';

                    const existingIds = Array.from(tbody.querySelectorAll('tr')).map(tr => tr.dataset.id);

                    data.forEach(function(company) {
                        if (existingIds.includes(String(company.id))) return;

                        const item = document.createElement('button');
                        item.type = 'button';
                        item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
                        item.textContent = company.name;

                        const addIcon = document.createElement('span');
                        addIcon.className = 'icon-plus text-success';
                        item.appendChild(addIcon);

                        item.addEventListener('click', function() {
                            addRelation(type, company.id, company.name, tbody);
                            item.remove();
                            if (!resultsDiv.children.length) resultsDiv.style.display = 'none';
                            updateCount();
                        });

                        resultsDiv.appendChild(item);
                    });
                });
        }

        searchBtn.addEventListener('click', doSearch);
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); doSearch(); }
        });

        tbody.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-relation');
            if (btn) {
                btn.closest('tr').remove();
                updateCount();
            }
        });
    }

    function addRelation(type, id, name, tbody) {
        const tr = document.createElement('tr');
        tr.dataset.id = id;
        tr.innerHTML =
            '<td>' + escapeHtml(name) + '</td>' +
            '<td><button type="button" class="btn btn-sm btn-danger remove-relation" data-type="' + type + '" data-id="' + id + '">' +
            '<span class="icon-times" aria-hidden="true"></span></button></td>' +
            '<input type="hidden" name="jform[' + type + '][]" value="' + id + '">';
        tbody.appendChild(tr);
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    initRelationTab('developers');
    initRelationTab('publishers');
});
</script>
