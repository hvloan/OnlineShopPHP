<!-- START PAGE CONTENT-->
<div class="page-heading">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div style="text-align: center; color: red; font-size: 30px; font-weight: 10px;"><b>THÔNG TIN ĐƠN HÀNG CỦA BẠN</b></div>
        </div>
        <div class="ibox-body" style="text-align: center; margin: 20px">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $value){?>
                    <tr>
                        <td><?=$value['NguoiNhan']?></td>
                        <td><?=$value['NgayLap']?></td>
                        <td><?=$value['DiaChi']?></td>
                        <td><?=number_format($value['TongTien'])?> VNĐ</td>
                        
                        <td><?=$value['SDT']?></td>
                        <td>
                            <?php if($value['TrangThai']==0) { 
                                echo 'Chưa duyệt';
                            } else echo 'Đã duyệt';?>
                        </td>
                        <td>
                            <a href="?act=history&xuli=chitiet&id=<?=$value['MaHD']?>" class="btn btn-success">View Details</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->