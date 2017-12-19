<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tweet $tweet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tweet->tweetid],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tweet->tweetid)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tweets'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tweets form large-9 medium-8 columns content">
    <?= $this->Form->create($tweet) ?>
    <fieldset>
        <legend><?= __('Edit Tweet') ?></legend>
        <?php
            echo $this->Form->control('user_id');
            echo $this->Form->control('tweet');
            echo $this->Form->control('created_at', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
