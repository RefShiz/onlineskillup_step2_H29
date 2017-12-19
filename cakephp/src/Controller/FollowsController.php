<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Follows Controller
 *
 * @property \App\Model\Table\FollowsTable $Follows
 *
 * @method \App\Model\Entity\Follow[] paginate($object = null, array $settings = [])
 */
class FollowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $follows = $this->paginate($this->Follows);

        $this->set(compact('follows'));
        $this->set('_serialize', ['follows']);
    }

    /**
     * View method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $follow = $this->Follows->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('follow', $follow);
        $this->set('_serialize', ['follow']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if ($this->request->is('post') && $id != null) {
            $follow = $this->Follows->newEntity();
            //$userid = $users->find()->where(['userid' => $auth->user('id')]);
            $follow->user_id  = $this->Auth->user('id');
            $follow->followed_userid  = $id;
            if ($this->Follows->save($follow)) {
                $this->Flash->success(__('フォローしました.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'resolt']);
            }
            $this->Flash->error(__('フォローに失敗しました.'));
        }
    }
    /**
     * Edit method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $follow = $this->Follows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $follow = $this->Follows->patchEntity($follow, $this->request->getData());
            if ($this->Follows->save($follow)) {
                $this->Flash->success(__('The follow has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The follow could not be saved. Please, try again.'));
        }
        $users = $this->Follows->Users->find('list', ['limit' => 200]);
        $this->set(compact('follow', 'users'));
        $this->set('_serialize', ['follow']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $follow = $this->Follows->get($id);
        if ($this->Follows->delete($follow)) {
            $this->Flash->success(__('The follow has been deleted.'));
        } else {
            $this->Flash->error(__('The follow could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
