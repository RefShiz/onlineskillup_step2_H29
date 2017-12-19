<div class="tweets form large-9 medium-8 columns content">

<?php // add tweet ?>
<?= $this->Form->create(null,['url' => ['action' => 'add']]) ?>
<fieldset>
    <legend><?= __('つぶやく') ?></legend>
    <?php
        echo 'ユーザ : '.$auth->user('userid');
        echo $this->Form->textarea('tweet');
    ?>
</fieldset>
<?= $this->Form->button(__('投稿する')) ?>
<?= $this->Form->end() ?>

<?php // tweets list ?>
<?= '<br>' ?>
<?= '<br>' ?>
<fieldset>
<legend><?= __('ホーム') ?></legend>
<table>
    <thead>
        <tr>
            <td><?= 'Nickname' ?></td>
            <td><?= 'Userid' ?></td>
            <td><?= 'Date' ?></td>
            <td><?= 'tweet' ?></td>
            <td><?= 'Action' ?></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tweets as $tweet): ?>
        <tr>
            <td><?= $this->Html->link($tweet->user->nickname, ['controller' => 'Users', 'action' => 'view', $tweet->user_id]) ?></td>
            <td><?= h($tweet->user->userid) ?></td>
            <td><?= h($tweet->created_at->format('Y-m-d H:i:s')) ?></td>
            <td><?= h($tweet->tweet) ?></td>
            <?php if ( $auth->user('userid') == $tweet->user->userid ) : ?>
            <td class="actions">
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tweet->tweetid], ['confirm' => __('ツイートを削除しますか # {0}?', $tweet->tweetid)]) ?>
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
