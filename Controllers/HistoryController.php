<?php
require_once("Models/history.php");
class HistoryController
{
    var $history_model;
    public function __construct()
    {
        $this->history_model = new History();
    }
    function list()
    {
        $data_danhmuc = $this->history_model->danhmuc();

        $data_chitietDM = array();

        for ($i = 1; $i <= count($data_danhmuc); $i++) {
            $data_chitietDM[$i] = $this->history_model->chitietdanhmuc($i);
        }

        $data = array();
        // if (isset($_GET['id'])) {
        //     $id = $_GET['id'];
        //     if ($id > 1) {
        //         $id = 0;
        //     }
        //     $data = $this->history_model->trangthai($id);
        // } else {
            $ma = $_SESSION['login']['MaND'];
            $data = $this->history_model->All_History($ma);
        // }
        require_once("Views/index.php");
    }
    function chitiet()
    {
        $id = $_GET['id'];
        $data = $this->history_model->chitietlichsu($id);
        require_once("Views/index.php");
    }
}
