<nav class="top-bar expanded" data-topbar role="navigation">
    <ul class="title-area large-3 medium-4 columns">
        <li class="name">
            <h1><?= $this->Html->link(__('Twitter Modoki'), ['controller' => 'Tweets','action' => 'index']) ?></h1>
        </li>
    </ul>
    <div class="top-bar-section">
        <ul class="right">
            <li><?= $this->Html->link(__('ホーム'), ['controller' => 'Tweets','action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('友達を検索'), ['controller' => 'Users','action' => 'search']) ?></li>
            <li><?= $this->Form->postLink(
                    __($auth->user('userid').' : ログアウト'),
                    ['controller' => 'Users','action' => 'logout'],
                    ['confirm' => __('本当にログアウトしますか ?')]
                )
                ?>
            </li>
        </ul>
    </div>
</nav>
<?= $this->Flash->render() ?>
