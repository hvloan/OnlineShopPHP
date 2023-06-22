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
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Đon Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $value) { ?>
                            <tr>
                                <td><?= $value['Ten'] ?></td>
                                <td><?= number_format($value['DonGia']) ?> VNĐ</td>
                                <td><?= $value['SoLuong'] ?></td>
                                <td><?= number_format($value['DonGia'] * $value['SoLuong']) ?> VNĐ</td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->



