<div class="users form large-9 medium-8 columns content">
<fieldset>
    <legend><?= __('ユーザ検索[検索内容:'.$find.']') ?></legend>

    <?php if($users != null): ?>
    <?php foreach ($users as $user): ?>
      <hr>
      <tr>
          <?= h($user->id) ?>
          <td><?= 'ユーザ名 : '.h($user->nickname) ?></td>
          <td><?= 'ユーザid : '.h($user->userid) ?></td>
          <?php if ( array_search($user->id, $follows)===false ) : //falseだったとき(0を考慮して===) ?>
          <td class="actions">
              <?= $this->Form->postLink(__('Follow'), ['controller' => 'Follows', 'action' => 'add', $user->id ]) ?>
          </td>
          <?php endif; ?>
      </tr>
      <hr>
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
    </div>
    <?php else: ?>
        <?= '対象のユーザが見つかりません' ?>
    <?php endif; ?>

</fieldset>
</div>
