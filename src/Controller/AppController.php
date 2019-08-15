<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        if ($this->request->getParam('action') === 'login') {
        $this->loadComponent('Recaptcha.Recaptcha');
    }

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
     

          $this->loadComponent('Auth', [
            'authorize' => ['Controller'],/*autrizacion de usuarios lo maneja el controller*/
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ],
                    'finder' => 'auth'/*le digo que va a ver un metodo finder llamado auth en usertable*/
                ]
            ],
            'loginAction' => [/*es una accion donde va a permitir ingresar los datos para loguearse*/
                'controller' => 'Users',
                'action' => 'login'
            ],
           /*si ingreso mal autherr..*/
            'authError' => 'Ingrese sus datos',
            /*si ingreso bien a home*/
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'home'
            ],
            /*cuando cierro Sesion*/
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            /* Si no está autorizado, devuélvalos a la página donde estaban en*/
            'unauthorizedRedirect' =>$this->referer()
 ]);
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    /*metodo callback este se activa ante de una funcionalidad, este antes de initialize*/
    public function beforeFilter(Event $event)
    {
        $this->set('current_user', $this->Auth->user());
    }
   /*metodo para definir autorizacion de usuario*/
     public function isAuthorized($user)
    {
          if(isset($user['role']) and $user['role'] === 'admin')
        {
            return true;
        }
        return false;
}
}