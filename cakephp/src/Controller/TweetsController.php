<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Tweets Controller
 *
 * @property \App\Model\Table\TweetsTable $Tweets
 *
 * @method \App\Model\Entity\Tweet[] paginate($object = null, array $settings = [])
 */
class TweetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'limit' => 10,
            'fields' => ['Tweets.tweetid','Tweets.user_id','Tweets.tweet','Tweets.created_at','Users.userid','Users.nickname'],
            'order' => ['Tweets.created_at' => 'desc'] //asc,desc
        ];

        $id = $this->Auth->user('id');
        $followlist = TableRegistry::get('Follows')->find()->where(['user_id =' => $id ])->all();
        $follows = array();
        foreach ($followlist as $follow) {
            $follows[] = array('user_id' => $follow->followed_userid); //フォロー者の追加
        }
        $follows[] = array('user_id' => $id ); //自身の追加
        $query = $this->Tweets->find()->where([ 'OR' => $follows ]); //ツイートの取得用
        $this->set('tweets',$this->paginate($query)); //取得と変数へのセット
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tweet = $this->Tweets->newEntity();
        if ( $this->request->is('post') && !empty($this->request->data['tweet']) ) {
            $tweet->user_id = $this->Auth->user('id');
            $tweet->tweet = $this->request->data['tweet'];
            $tweet->created_at = Time::now();
            if ($this->Tweets->save($tweet)) {
                $this->Flash->success(__('ツイートしました.'));

                return $this->redirect(['controller' => 'Tweets', 'action' => 'index']);
            }
            $this->Flash->error(__('ツイートに失敗しました.'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tweet = $this->Tweets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tweet = $this->Tweets->patchEntity($tweet, $this->request->getData());
            if ($this->Tweets->save($tweet)) {
                $this->Flash->success(__('The tweet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tweet could not be saved. Please, try again.'));
        }
        $this->set(compact('tweet'));
        $this->set('_serialize', ['tweet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $tweet = $this->Tweets->get($id);
        if ($this->Auth->user('id')==$tweet->user_id){
            $this->request->allowMethod(['post', 'delete']);
        }
        if ($this->Tweets->delete($tweet)) {
            $this->Flash->success(__('ツイートを削除しました.'));
        } else {
            $this->Flash->error(__('ツイートの削除に失敗しました.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
