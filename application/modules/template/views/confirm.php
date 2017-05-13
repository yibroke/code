<div class="container">

    <div class="col-md-6">
        <h1>Vận chuyển</h1>
        <table class="table">

                <tr>
                    <td>Tên khách hàng</td>
                    <td> <?php echo $query->name;  ?></td>
                </tr>
                <tr>
                    <th>Điện thoại</th>
                    <td> <?php echo $query->phone;  ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td> <?php echo $query->email;  ?></td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>  <?php echo $query->address. ', '.$query->dis_type. ' '.$query->dis_name.' ,'.$query->pro_type. ' '.$query->pro_name;  ?></td>
                </tr>
               
                
                <tr>
                    <th>Ghi Chú</th>
                    <td>  <?php echo $query->note;  ?></td>
                </tr>
            </table>
        <a href="<?php echo base_url(); ?>customer/insert">Thay Doi</a>
    </div>
    <div class="col-md-6">
        <?php $this->load->view('order/include_cart'); ?>
           <?php echo form_open('order/validation', array('id' => 'form_category', 'role' => 'form','novalidate' => '')); ?>
                    <input type="hidden" class="form-control" name="fk_cus_id" id="con_name" required="required" value="<?php echo $cus_id; ?>">
                    <input type="hidden" class="form-control" name="address" id="con_name" required="required" value="0">
                    <input type="hidden" class="form-control" name="payment" id="con_email" required="required" value="1">
                    <input type="hidden" class="form-control" name="is_pay" id="con_email" required="required" value="0">
                <button type="submit" class="btn btn-success btn-block">Hoàn Thành</button>
            <?php echo form_close(); ?>
        
    </div>
</div>
