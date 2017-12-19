<nav class="top-bar expanded" data-topbar role="navigation">
    <ul class="title-area large-3 medium-4 columns">
        <li class="name">
            <h1><?= $this->Html->link(__('Twitter Modoki'), ['controller' => 'Tweets','action' => 'index']) ?>
        </li>
    </ul>
    <div class="top-bar-section">
        <ul class="right">
            <li><?= $this->Html->link(__('ホーム'), ['controller' => 'Tweets','action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('ユーザ登録'), ['controller' => 'Users','action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('ログイン'), ['controller' => 'Users','action' => 'login']) ?></li>
        </ul>
    </div>
</nav>
