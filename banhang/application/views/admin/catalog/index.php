<?php
// load ra file head
$this->load->view('admin/catalog/head', $this->data);
?>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">


        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">

            <thead>
            <tr>
                <td style="width:10px;"><img src="<?php echo public_url(); ?>/admin/images/icons/tableArrows.png" /></td>

                <td style="width: 100px;">Tên danh muc</td>
                <td style="width:100px;">Chức năng</td>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <td colspan="8">
                    <div class="list_action itemActions">
                        <a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('catalog/delete_all'); ?>">
                            <span style='color:white;'>Xóa hết</span>
                        </a>
                    </div>

                    <div class='pagination'>
                    </div>
                </td>
            </tr>
            </tfoot>

            <tbody>
            <?php foreach ($list as $row): ?>
                <tr class="row_<?php echo $row->id_catalog; ?>">
                    <td><input type="checkbox" name="id[]" value="<?php echo $row->id_catalog; ?>" /></td>
                    <td style="color:red;"><?php echo $row->name; ?>

                    </td>

                    <td class="option">
                        <a href="<?php echo admin_url('catalog/edit/'.$row->id_catalog); ?>" title="Chỉnh sửa" class="tipS ">
                            <img src="<?php echo public_url(); ?>/admin/images/icons/color/edit.png" />
                        </a>

                        <a href="<?php echo admin_url('catalog/delete/'.$row->id_catalog); ?>" title="Xóa" class="tipS verify_action" >
                            <img src="<?php echo public_url(); ?>/admin/images/icons/color/delete.png" />
                        </a>
                    </td>
                </tr>
            <?php foreach ($row->subs as $sub): ?>
                <tr class="row_<?php echo $sub->id_catalog; ?>">
                    <td><input type="checkbox" name="id[]" value="<?php echo $row->id_catalog; ?>" /></td>
                    <td style="padding-left: 20px;"><?php echo $sub->name; ?>

                    </td>

                    <td class="option">
                        <a href="<?php echo admin_url('catalog/edit/'.$sub->id_catalog); ?>" title="Chỉnh sửa" class="tipS ">
                            <img src="<?php echo public_url(); ?>/admin/images/icons/color/edit.png" />
                        </a>

                        <a href="<?php echo admin_url('catalog/delete/'.$sub->id_catalog); ?>" title="Xóa" class="tipS verify_action" >
                            <img src="<?php echo public_url(); ?>/admin/images/icons/color/delete.png" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</div>

<div class="clear mt30"></div>
