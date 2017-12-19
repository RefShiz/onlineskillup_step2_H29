<?php // src/Template/Uesrs/search.ctp ?>

<div class="users form large-9 medium-8 columns content">

    <?= $this->Form->create(null,['url' => ['action' => 'resolt']]) ?>
    <fieldset>
        <legend><?= __('ユーザ検索') ?></legend>
        <?php
            echo $this->Form->input('find');
        ?>
    </fieldset>
    <?= $this->Form->button(__('検索')) ?>
    <?= $this->Form->end() ?>

</div>
