<h3><?= __('Follows') ?></h3>

<table cellpadding="0" cellspacing="0">
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $this->Number->format($user->userid) ?></td>
        <td><?= h($user->name) ?></td>
        <td><?= h($user->nickname) ?></td>
        <td><?= h($user->mail) ?></td>
        <td><?= h($user->private) ?></td>
        <td><?= h($user->registered_at->format('Y-m-d H:i:s')) ?></td>
        <td><?= h($user->passwords[0]['password']) ?></td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $user->userid]) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->userid]) ?>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->userid],$
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>
