<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
date_default_timezone_set('Asia/Tokyo');

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout','login']);
    }

    public function login()
    {
        if ($this->request->is('post') && $this->request->data['userid']!=null) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        $this->request->session()->destroy(); // セッションの破棄
        return $this->redirect($this->Auth->logout());
    }

    public function search()
    {
        $session = $this->request->session();
        if (!empty($session->read('userSearch'))) {
            $session->delete('userSearch');
            $this->redirect(['action' => 'search']);
        }
    }

    public function resolt()
    {
        $session = $this->request->session();
        if ($this->request->is('POST')) {
            $session->write(['userSearch' => $this->request->data['find']]);
            $this->redirect(['action' => 'resolt']);
        }

        $this->paginate = [
            'limit' => 10,
            'fields' => ['Users.id','Users.userid','Users.nickname','Users.modified_at'],
            'order' => ['Users.modified_at' => 'asc'],
            //'contain' => []
        ];

        if (!empty($session->read('userSearch'))) {
            $find = $session->read('userSearch');
            $query = $this->Users->find()->where(["userid like " => '%'.$find.'%']);
            $this->set('find', $find);
            $this->set('users',$this->paginate($query));
        }
        else {
            $this->set('find', '');
            $this->set('users', null);
        }

        $id = $this->Auth->user('id');
        $followlist = TableRegistry::get('Follows')->find()->where(['user_id =' => $id ])->all();
        $follows = array();
        foreach ($followlist as $follow) {
            $follows[] = $follow->followed_userid; //フォロー者の追加
        }
        $follows[] = $id; //自身の追加
        $this->set('follows',$follows); //取得と変数へのセット
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if ($id == null){ $id = $this->Auth->user('id'); }

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);

        $this->paginate = [
            'limit' => 10,
            'order' => ['Tweets.created_at' => 'desc'] //asc,desc
        ];
        $this->Tweets = TableRegistry::get('Tweets');
        $query = $this->Tweets->find()->where([ 'user_id =' => $id ]); //ツイートの取得用
        $this->set('tweets',$this->paginate($query)); //取得と変数へのセット
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $datetime = Time::now();
            $data['registered_at'] = $datetime;
            $data['modified_at'] = $datetime;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $datetime = Time::now();
            $data['modified_at'] = $datetime;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        //$user = $this->Users->get($id);
        //if ($this->Users->delete($user)) {
        //    $this->Flash->success(__('The user has been deleted.'));
        //} else {
        //    $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        //}

        //return $this->redirect(['action' => 'index']);
    }
}
