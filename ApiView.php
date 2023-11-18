<?php 

class ApiView {
    public function response($data, $status) {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        if($data) {
            echo json_encode($data);
        }else {
            echo "no hay nada";
        }
    }
    private function _requestStatus($code) {
        $status = array(
            200 => "OK",
            404 => "Not Found",
            500 => "Internal server error",
        );
        return (isset($status[$code])) ? $status[$code] : $status[500];
    }
}


?>