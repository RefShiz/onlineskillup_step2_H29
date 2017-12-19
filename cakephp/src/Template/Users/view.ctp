<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users view large-9 medium-8 columns content">

<h3><?= h('ユーザ：'.$user->nickname) ?></h3>
<table class="vertical-table">
    <tr>
        <th scope="row"><?= __('Nickname') ?></th>
        <td><?= h($user->nickname) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Userid') ?></th>
        <td><?= h($user->userid) ?></td>
    </tr>
</table>

<fieldset>
<legend><?= __('ツイート') ?></legend>
<table>
    <thead>
        <tr>
            <td><?= 'Date' ?></td>
            <td><?= 'tweet' ?></td>
            <td><?= 'Action' ?></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tweets as $tweet): ?>
        <tr>
            <td><?= h($tweet->created_at->format('Y-m-d H:i:s')) ?></td>
            <td><?= h($tweet->tweet) ?></td>
            <?php if ( $auth->user('id') == $tweet->user_id ) : ?>
            <td class="actions">
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tweets','action' => 'delete', $tweet->tweetid], ['confirm' => __('ツイートを削除しますか # {0}?', $tweet->tweetid)]) ?>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
</div>
</fieldset>

</div>
