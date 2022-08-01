<?php
class NumberController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
         $arrQueryStringParams = $this->getQueryStringParams();
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $numberModel = new NumberModel("number.sqlite");
 
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    
                    $intLimit = $arrQueryStringParams['limit'];
                   
                }
               
                
                $arrUsers = $numberModel->getNumber($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }




    public function post()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';

        if (strtoupper($requestMethod) == 'POST') {
            try {


                $myPost = array_values($_POST);
                $numberModel = new NumberModel("number.sqlite");

                if (count($myPost) == 1 && isset($_POST["number"])) {
                    $number = (int)$_POST["number"] ;
                } else {$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                    array('Content-Type: application/json', $strErrorHeader)
                );}

                if(isset($number) && is_int($number) && $number != null){
                
                    $numberModel -> postNumber($number);
                    $this->sendOutput(
                        json_encode(["success" => "true"]),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );

            
        }  else {$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
            array('Content-Type: application/json', $strErrorHeader)
        );}
                
                
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if ($strErrorDesc) {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
            array('Content-Type: application/json', $strErrorHeader)
        );
          
        } 
        
    }
}
