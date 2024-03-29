<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
/*permisos si no esta autentificado*/
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
    }

    /*autorizacion de usuarios*/
    public function isAuthorized($user)
    {
        if(isset($user['role']) and $user['role'] === 'user')
        {
               /*si el usuario tiene permiso a estas acciones*/
            if(in_array($this->request->action, ['home', 'view', 'logout']))
            {
                return true;
            }
        }
        return parent::isAuthorized($user);/*mando a metodo appcontroller */
    }


    public function login()
    {
          


       /*verifico la peticion del isuario*/
        if($this->request->is('post'))
        {
             if ($this->Recaptcha->verify()) { 
                 /*verifica los datos con los que se identifico*/
            $user = $this->Auth->identify();
            if($user)/* si existen los datos*/
            {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());

            }
            else
            {

                $this->Flash->err('Datos son invalidos, por favor intente nuevamente', ['key' => 'auth']);
            }
            } else {
            // You can debug developers errors with
            // debug($this->Recaptcha->errors());
            $this->Flash->err(__('Please check your Recaptcha Box.'));
        }
               
        }
        /**si el usuario esta Auth q me redireccione a mi home, para que no vuelva a login */
        if ($this->Auth->user())
        {
            return $this->redirect(['controller'=>'Users','action'=>'home']);
        }
     }
     public function home()
    {
       

        $this->render();
    }
     public function logout()
    {
       

      return  $this->redirect($this->Auth->logout());
    }

    public function index()
    {
        $keyword =$this->request->query('keyword' );

    // $users = $this->Users->findAllByFirst_name($keyword);
    
         // $this->paginate = ['conditions'=>['first_name'=>$keyword]];
        
     $users = $this->Users->findByFirst_name($keyword);
        $users = $this->paginate($this->Users);
        
        $this->set(compact('users'));
    }

    public function buscar( )
    {
      
          $keyword =$this->request->query('keyword');
          $users = $this->Users->findAllByFirst_name($keyword);
    //       array(
     //     'fields'=> array(
      //    'first_name' ,
     //     'last_name' 
   //   ),
   //     'conditions' => array('first_name =' => $keyword), 
   //  )
  //  );
        $this->set(compact('users')); 
    }



    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, /*obtengo mi id de la tabla users*/
                [
            'contain' => ['Bookmarks']
        ]);

        $this->set('user', $user);/*mandamos los datos del usuario*/
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $user = $this->Users->newEntity();/*creo una nueva entidad*/
        if ($this->request->is('post')) {
                /*valida datos*/
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->role ='user';
            $user->active =1;
            if ($this->Users->save($user)) {
                $this->Flash->ok(('El usuario ha sido guardado'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->err(('El Usuario no se guardo.Intente nuevamente'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   /*setpassword metodo contraseña*/
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [/*recuperar el usuario*/
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->ok(__('El Usuario ha sido actualizado'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->err(__('No se pudo Editar. Intente nuevamente'));
        }
        $this->set(compact('user'));
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
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->ok(__('El usuario borro correctamente'));
        } else {
            $this->Flash->err(__('El usuario no se borro correctamente. Intenta nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
