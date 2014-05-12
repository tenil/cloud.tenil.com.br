<?php

namespace TenilUserRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UserRestController extends AbstractRestfulController {

    // Listar registros - GET
    /*
     * http://jk.local/api/user
     */
    public function getList() {

//        return new JsonModel(array('data'=>array('nome'=>'Tenil')));

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $result = $em->getRepository('TenilUser\Entity\User')
                ->findArray();

        return new JsonModel(array('data' => $result));
    }

    // Retornar registro específico - GET
    /*
     * http://jk.local/api/user/1
     */
    public function get($id) {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $result = $em->getRepository('TenilUser\Entity\User')
                ->find($id);

        $return = ($result) ? array('data' => $result->toArray()) : NULL;

        return new JsonModel($return);
    }

    // Inserir registro - POST
    /*
     * curl -i -H "Accept: application/json" -X POST -d "nome=Rest User&email=roberto.tenil@gmail.com&password=123456" http://jk.local/api/user
     */
    public function create($data) {

        $userService = $this->getServiceLocator()->get('TenilUser\Service\User');

        if ($data) {
            $user = $userService->insert($data);
            if ($user) {
                return new JsonModel(array('data' => array('id' => $user->getId(), 'success' => TRUE)));
            } else {
                return new JsonModel(array('data' => array('success' => FALSE)));
            }
        } else {
            return new JsonModel(array('data' => array('success' => FALSE)));
        }
    }

    // Alterar registro - PUT
    /*
     * curl -i -H "Accept: application/json" -X PUT -d "nome=Rest User Alterado&email=roberto.tenil@gmail.com&password=123456" http://jk.local/api/user/8
     */
    public function update($id, $data) {

        $userService = $this->getServiceLocator()->get('TenilUser\Service\User');

        if ($data) {
            $data['id'] = $id;
            $user = $userService->update($data);

            if ($user) {
                return new JsonModel(array('data' => array('id' => $user->getId(), 'success' => TRUE)));
            } else {
                return new JsonModel(array('data' => array('success' => FALSE)));
            }
        } else {
            return new JsonModel(array('data' => array('success' => FALSE)));
        }
    }

    // Apagar registro - DELETE
    /*
     * curl -i -H "Accept: application/json" -X DELETE http://jk.local/api/user/8
     */
    public function delete($id) {

        $userService = $this->getServiceLocator()->get('TenilUser\Service\User');

        // Sempre será verdadeiro se o id for passado como parâmetro, não testa a deleção no banco.
        if ($id) {
            $user = $userService->delete($id);
            return new JsonModel(array('data' => array('id' => $user, 'success' => TRUE)));
        } else {
            return new JsonModel(array('data' => array('success' => FALSE)));
        }
    }

}
