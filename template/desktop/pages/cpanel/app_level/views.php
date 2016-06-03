<?php
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.0
    * @package    : IBeESNay
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
echo form_open('level/delete', array('id'=>'form')); ?>
    <div class="clearfix">
        <?php echo anchor('level/create/new','<i class="fa fa-plus-circle"></i>&nbsp; Level soal baru&nbsp;&nbsp;',array('class'=>'add btn btn-info btn-sm')); ?>&nbsp;&nbsp;
        <button type="submit" class="delete btn btn-danger btn-sm btn-grad" title="Hapus" name="hapus"><i class="fa fa-trash"></i> &nbsp;Hapus data</button>
        <div class="pull-right tableTools-container"></div>
    </div>
    <div class='space-6'></div>
    <div>
	<table id="data-table" class="tablenay table table-striped table-bordered table-hover" data-tablenay-mode="stack" data-tablenay-sortable data-tablenay-sortable-switch data-tablenay-minimap data-tablenay-mode-switch>
            <thead>
                <tr>
                    <th style="width:3% !important;" class="center no-sortable">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" id='checkall' target='cek_data[]' />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="persist" style="width:20% !important;">Nama level</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-sortable-default-col data-tablenay-priority="3" style="width:20% !important;">Keterangan</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:10% !important;">Jumlah Soal</th>
                    <th scope="col" data-tablenay-priority="3" style="width:5% !important;color:#555">Pilihan</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($num_rows > 0):
                foreach ($record as $rows):
                    echo "<tr>";
                    echo "<td align='center'><label class='pos-rel'>
                            <input type='checkbox' class='ace' name='cek_data[]' value='$rows->id_level' />
                            <span class='lbl'></span>
			    </label>
                         </td>";
                    echo "<td>$rows->nama_level</td>";
                    echo "<td>$rows->keterangan</td>";
                    $query_u  = $this->db->select('id_soal');
                    $query_u  = $this->db->where('id_level',$rows->id_level);
                    $query_u  = $this->db->get('bank_soal');
                    $jumlah_u = $query_u->num_rows();
                    if($jumlah_u > 0 ) {
                        echo "<td class='success'><a>$jumlah_u bank soal</a>&nbsp;&nbsp;</td>";
                    } else {
                        echo "<td class='danger'><a>$jumlah_u</a>&nbsp;&nbsp;</td>";
                    }

                    echo "<td>".anchor('level/update/kode/'.$rows->id_level,'<i class="fa fa-edit"></i> &nbsp;Ubah',array('class'=>''))."</td>";
                    echo '</tr>';
                endforeach;
                else:
                echo "<tr class='danger'><td colspan='5' align='center'>
                      <h3><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Data belum ada</h3>
                      <p>Silahkan buat level soal baru dengan menu yang telah disediakan.</p>
                      </td></tr>";
                endif;
                ?>
            </tbody>
        </table>
    </div>
</form>