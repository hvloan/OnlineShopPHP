<?php
require_once("model.php");
class History extends Model
{
    var $table = "hoadon";
    var $contens = "MaHD";
    function trangthai($id){
        $query = "select * from HoaDon where TrangThai = $id  ORDER BY MaHD DESC";

        require("result.php");

        return $data;
    }
    function chitietlichsu($id){
        $query = "select ct.*, s.TenSP as Ten from chitiethoadon as ct, sanpham as s where ct.MaSP = s.MaSP and ct.MaHD = $id ";

        require("result.php");
        
        return $data;
    }
    function All_History($ma)
    {
        $query = "select hd.* from hoadon as hd, sanpham as sp, chitiethoadon as ct where hd.MaND = $ma and hd.MaHD = ct.MaHD and ct.MaSP = sp.MaSP group by hd.MaHD";

        require("result.php");

        return $data;
        
    }
}