<?php
/**
 *  Sample Foo Resource
 */
class Account_FooController extends REST_Controller
{
    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     */
    public function indexAction()
    {
        $this->view->message = 'indexAction has been called.';
        $this->_response->ok();
    }

    /**
     * The head action handles HEAD requests; it should respond with an
     * identical response to the one that would correspond to a GET request,
     * but without the response body.
     */
    public function headAction()
    {
        $this->view->message = 'headAction has been called';
        $this->_response->ok();


    }

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    public function getAction()
    {
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
        $this->view->message = sprintf('Resource #%s', $id);
        $this->_response->ok();
    }

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
     */
    public function postAction()
    {

        $model = $this->_Modellogin();
        $username = $this->_request->getParam('username');
        $password = md5($this->_request->getParam('password'));

        $data =$model->getLogin($username,$password);
        if(!empty($data)){
            $this->view->response = $data;
        }else{
            $this->view->message = 'Data Tidak Ditemukan';
        }

        $this->_response->created();
    }

    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
     */
    public function putAction()
    {
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
        $this->view->params = $this->_request->getParams();
        $this->view->message = sprintf('Resource #%s Updated', $id);
        $this->_response->ok();
    }

    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
     */
    public function deleteAction()
    {
        $id = $this->_getParam('id', 0);
        $this->view->id = $id;
        $this->view->message = sprintf('Resource #%s Deleted', $id);
        $this->_response->ok();
    }

    protected function _Modellogin(){
        $data = new Api_Model_Login();
        return $data;

    }


}