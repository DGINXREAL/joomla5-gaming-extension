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
$dlcs       = $this->dlcs;
$platforms  = $this->platforms;
$gameId     = (int) $this->item->id;
?>

<form action="<?php echo Route::_('index.php?option=com_games&layout=edit&id=' . $gameId); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">

    <?php echo HTMLHelper::_('uitab.startTabSet', 'gameTab', ['active' => 'details', 'recall' => true, 'breakpoint' => 768]); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'gameTab', 'details', Text::_('COM_GAMES_TAB_DETAILS')); ?>
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
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'gameTab', 'developers', Text::_('COM_GAMES_FIELD_DEVELOPERS_LABEL') . ' <span class="badge bg-secondary" id="developers-count">' . count($developers) . '</span>'); ?>
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
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'gameTab', 'publishers', Text::_('COM_GAMES_FIELD_PUBLISHERS_LABEL') . ' <span class="badge bg-secondary" id="publishers-count">' . count($publishers) . '</span>'); ?>
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
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'gameTab', 'dlcs', Text::_('COM_GAMES_TAB_DLCS') . ' <span class="badge bg-secondary" id="dlcs-count">' . count($dlcs) . '</span>'); ?>
            <?php if ($gameId > 0) : ?>
                <div class="card mb-3" id="dlc-form-card">
                    <div class="card-header">
                        <strong id="dlc-form-title"><?php echo Text::_('COM_GAMES_DLC_NEW'); ?></strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><?php echo Text::_('COM_GAMES_FIELD_NAME_LABEL'); ?></label>
                                    <input type="text" class="form-control" id="dlc-name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><?php echo Text::_('COM_GAMES_FIELD_SLUG_LABEL'); ?></label>
                                    <input type="text" class="form-control" id="dlc-slug" placeholder="<?php echo Text::_('COM_GAMES_FIELD_SLUG_HINT'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><?php echo Text::_('COM_GAMES_FIELD_PLATFORM_LABEL'); ?></label>
                                    <select class="form-select" id="dlc-platform_id">
                                        <option value="">- <?php echo Text::_('COM_GAMES_SELECT_PLATFORM'); ?> -</option>
                                        <?php foreach ($platforms as $plat) : ?>
                                            <option value="<?php echo $plat->id; ?>"><?php echo $this->escape($plat->name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><?php echo Text::_('COM_GAMES_FIELD_RELEASED_AT_LABEL'); ?></label>
                                    <input type="date" class="form-control" id="dlc-released_at">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo Text::_('COM_GAMES_FIELD_DECK_LABEL'); ?></label>
                            <input type="text" class="form-control" id="dlc-deck">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo Text::_('COM_GAMES_FIELD_DESCRIPTION_LABEL'); ?></label>
                            <textarea class="form-control" id="dlc-description" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo Text::_('COM_GAMES_FIELD_IMAGE_LABEL'); ?></label>
                            <input type="text" class="form-control" id="dlc-image_id" placeholder="images/...">
                        </div>
                        <input type="hidden" id="dlc-edit-id" value="">
                        <button type="button" class="btn btn-success" id="dlc-save-btn">
                            <span class="icon-save" aria-hidden="true"></span>
                            <?php echo Text::_('JAPPLY'); ?>
                        </button>
                        <button type="button" class="btn btn-secondary" id="dlc-cancel-btn" style="display:none;">
                            <?php echo Text::_('JCANCEL'); ?>
                        </button>
                    </div>
                </div>

                <table class="table" id="dlc-list">
                    <thead>
                        <tr>
                            <th><?php echo Text::_('COM_GAMES_FIELD_NAME_LABEL'); ?></th>
                            <th><?php echo Text::_('COM_GAMES_FIELD_PLATFORM_LABEL'); ?></th>
                            <th><?php echo Text::_('COM_GAMES_FIELD_RELEASED_AT_LABEL'); ?></th>
                            <th class="w-20"><?php echo Text::_('JACTION_EDIT'); ?> / <?php echo Text::_('JACTION_DELETE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dlcs as $dlc) : ?>
                            <tr data-id="<?php echo $dlc->id; ?>">
                                <td><?php echo $this->escape($dlc->name); ?></td>
                                <td><?php echo $this->escape($dlc->platform_name ?? '—'); ?></td>
                                <td><?php echo $dlc->released_at ?: '—'; ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary dlc-edit-btn" data-id="<?php echo $dlc->id; ?>">
                                        <span class="icon-pencil-alt" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger dlc-delete-btn" data-id="<?php echo $dlc->id; ?>">
                                        <span class="icon-times" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert alert-info">
                    <?php echo Text::_('COM_GAMES_DLC_SAVE_GAME_FIRST'); ?>
                </div>
            <?php endif; ?>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

    <?php echo HTMLHelper::_('uitab.endTabSet'); ?>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = '<?php echo Session::getFormToken(); ?>';
    const searchUrl = '<?php echo Route::_('index.php?option=com_games&task=ajax.searchCompanies&format=json', false); ?>';
    const gameId = <?php echo $gameId; ?>;

    // --- Relation tabs (developers/publishers) ---
    function initRelationTab(type) {
        const prefix = type.slice(0, -1);
        const searchInput = document.getElementById(prefix + '-search');
        const searchBtn = document.getElementById(prefix + '-search-btn');
        const resultsDiv = document.getElementById(prefix + '-results');
        const tbody = document.querySelector('#' + prefix + '-list tbody');
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

    // --- DLC tab ---
    if (gameId > 0) {
        const dlcFields = ['name', 'slug', 'platform_id', 'released_at', 'deck', 'description', 'image_id'];
        const dlcSaveBtn = document.getElementById('dlc-save-btn');
        const dlcCancelBtn = document.getElementById('dlc-cancel-btn');
        const dlcEditId = document.getElementById('dlc-edit-id');
        const dlcFormTitle = document.getElementById('dlc-form-title');
        const dlcTbody = document.querySelector('#dlc-list tbody');
        const dlcCountBadge = document.getElementById('dlcs-count');
        const saveDlcUrl = '<?php echo Route::_('index.php?option=com_games&task=ajax.saveDlc&format=json', false); ?>';
        const deleteDlcUrl = '<?php echo Route::_('index.php?option=com_games&task=ajax.deleteDlc&format=json', false); ?>';
        const getDlcsUrl = '<?php echo Route::_('index.php?option=com_games&task=ajax.getDlcs&format=json', false); ?>';

        function updateDlcCount() {
            dlcCountBadge.textContent = dlcTbody.querySelectorAll('tr').length;
        }

        function clearDlcForm() {
            dlcFields.forEach(f => { document.getElementById('dlc-' + f).value = ''; });
            dlcEditId.value = '';
            dlcFormTitle.textContent = '<?php echo Text::_('COM_GAMES_DLC_NEW', true); ?>';
            dlcCancelBtn.style.display = 'none';
        }

        function loadDlcIntoForm(dlcData) {
            dlcEditId.value = dlcData.id;
            dlcFields.forEach(f => {
                document.getElementById('dlc-' + f).value = dlcData[f] || '';
            });
            dlcFormTitle.textContent = '<?php echo Text::_('COM_GAMES_DLC_EDIT', true); ?>';
            dlcCancelBtn.style.display = 'inline-block';
        }

        dlcSaveBtn.addEventListener('click', function() {
            const name = document.getElementById('dlc-name').value.trim();
            if (!name) { alert('Name is required'); return; }

            const params = new URLSearchParams();
            params.append(token, '1');
            params.append('dlc[game_id]', gameId);
            if (dlcEditId.value) params.append('dlc[id]', dlcEditId.value);
            dlcFields.forEach(f => {
                params.append('dlc[' + f + ']', document.getElementById('dlc-' + f).value);
            });

            fetch(saveDlcUrl, { method: 'POST', body: params })
                .then(r => r.json())
                .then(response => {
                    if (response.success) {
                        refreshDlcList();
                        clearDlcForm();
                    } else {
                        alert(response.message || 'Error saving DLC');
                    }
                });
        });

        dlcCancelBtn.addEventListener('click', clearDlcForm);

        function refreshDlcList() {
            fetch(getDlcsUrl + '&game_id=' + gameId + '&' + token + '=1')
                .then(r => r.json())
                .then(response => {
                    const data = response.data || [];
                    dlcTbody.innerHTML = '';
                    data.forEach(function(dlc) {
                        const tr = document.createElement('tr');
                        tr.dataset.id = dlc.id;
                        tr.innerHTML =
                            '<td>' + escapeHtml(dlc.name) + '</td>' +
                            '<td>' + escapeHtml(dlc.platform_name || '—') + '</td>' +
                            '<td>' + (dlc.released_at || '—') + '</td>' +
                            '<td>' +
                                '<button type="button" class="btn btn-sm btn-primary dlc-edit-btn" data-id="' + dlc.id + '">' +
                                    '<span class="icon-pencil-alt" aria-hidden="true"></span></button> ' +
                                '<button type="button" class="btn btn-sm btn-danger dlc-delete-btn" data-id="' + dlc.id + '">' +
                                    '<span class="icon-times" aria-hidden="true"></span></button>' +
                            '</td>';
                        dlcTbody.appendChild(tr);
                    });
                    updateDlcCount();
                });
        }

        dlcTbody.addEventListener('click', function(e) {
            const editBtn = e.target.closest('.dlc-edit-btn');
            const deleteBtn = e.target.closest('.dlc-delete-btn');

            if (editBtn) {
                const id = editBtn.dataset.id;
                fetch(getDlcsUrl + '&game_id=' + gameId + '&' + token + '=1')
                    .then(r => r.json())
                    .then(response => {
                        const dlc = (response.data || []).find(d => String(d.id) === String(id));
                        if (dlc) loadDlcIntoForm(dlc);
                    });
            }

            if (deleteBtn) {
                if (!confirm('<?php echo Text::_('COM_GAMES_DLC_CONFIRM_DELETE', true); ?>')) return;
                const id = deleteBtn.dataset.id;
                const params = new URLSearchParams();
                params.append(token, '1');
                params.append('id', id);
                fetch(deleteDlcUrl, { method: 'POST', body: params })
                    .then(r => r.json())
                    .then(response => {
                        if (response.success) {
                            refreshDlcList();
                            if (dlcEditId.value === String(id)) clearDlcForm();
                        }
                    });
            }
        });
    }
});
</script>
