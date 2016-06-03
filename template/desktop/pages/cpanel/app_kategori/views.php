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
echo form_open('jenis/delete', array('id'=>'form')); ?>
    <div class="clearfix">
        <?php echo anchor('jenis/create/new','<i class="fa fa-plus-circle"></i>&nbsp; Kategori ujian baru&nbsp;&nbsp;',array('class'=>'add btn btn-info btn-sm')); ?>&nbsp;&nbsp;
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
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="persist" style="width:30% !important;">Nama Kategori</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-sortable-default-col data-tablenay-priority="3" style="width:20% !important;">Keterangan</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:10% !important;">Jumlah Ujian</th>
                    <th scope="col" data-tablenay-priority="3" style="width:5% !important;color:#555">Pilihan</th>
                </tr>
            </thead>
            <tbody>
			<?php
			if($num_rows > 0):
                foreach ($record as $rows):
                    echo "<tr>";
                    echo "<td align='center'><label class='pos-rel'>
                            <input type='checkbox' class='ace' name='cek_data[]' value='$rows->id_kategori' />
                            <span class='lbl'></span>
			    </label>
                         </td>";
                    echo "<td>$rows->nama_kategori</td>";
                    echo "<td>$rows->keterangan</td>";
                    $query_u  = $this->db->select('id_ujian');
                    $query_u  = $this->db->where('id_kategori',$rows->id_kategori);
                    $query_u  = $this->db->get('topik_ujian');
                    $jumlah_u = $query_u->num_rows();
                    if($jumlah_u > 0 ) {
                        echo "<td class='success'><a>$jumlah_u</a>&nbsp;&nbsp;</td>";
                    } else {
                        echo "<td class='danger'><a>$jumlah_u</a>&nbsp;&nbsp;</td>";
                    }
                    echo "<td>".anchor('jenis/update/kode/'.$rows->id_kategori,'<i class="fa fa-edit"></i> &nbsp;Ubah',array('class'=>''))."</td>";
                    echo '</tr>';
                endforeach;
				else:
				echo "<tr class='danger'><td colspan='5' align='center'>
					  <h3><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Data belum ada</h3>
					  <p>Silahkan buat kategori tes atau ujian baru dengan menu yang telah disediakan.</p>
					  </td></tr>";
				endif;
                ?>
            </tbody>
        </table>
    </div>
</form>
