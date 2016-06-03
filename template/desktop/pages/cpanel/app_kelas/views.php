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
echo form_open('kelas/delete', array('id'=>'form')); ?>
    <div class="clearfix">
        <?php echo anchor('kelas/create/new','<i class="fa fa-plus-circle"></i>&nbsp; Kelas baru&nbsp;&nbsp;',array('class'=>'add btn btn-info btn-sm')); ?>&nbsp;&nbsp;
        <button type="submit" class="delete btn btn-danger btn-sm btn-grad" title="Hapus" name="hapus"><i class="fa fa-trash"></i> &nbsp;Hapus data</button>
        <div class="pull-right tableTools-container" style="width: 40%;">
            <a class="pull-right btn btn-sm" data-toggle="modal" href="#advanced" style="height: 34px;margin-left: 5px"><i class="fa fa-cog"></i> Penelusuran</a>
        </div>
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
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="persist" style="width:20% !important;">Nama Kelas</th>
                    <th scope="col" data-tablenay-sortable-col style="width:10% !important;">Sub Kelas</th>
                    
                    <th scope="col" data-tablenay-sortable-col data-tablenay-sortable-default-col data-tablenay-priority="3" style="width:20% !important;">Wali Kelas</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:8% !important;">Jumlah Siswa</th>
                    <th scope="col" data-tablenay-priority="3" style="width:5% !important;color:#555">Pilihan</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($num_rows > 0):
                foreach ($record as $rows):
                    echo "<tr>";
                    echo "<td align='center'><label class='pos-rel'>
                            <input type='checkbox' class='ace' name='cek_data[]' value='$rows->id_kelas' />
                            <span class='lbl'></span>
			    </label>
                         </td>";
                    echo "<td>$rows->nama</td>";
                    $query1  = $this->db->query("SELECT * FROM sub_kelas WHERE id_sub='$rows->id_sub'");
                    $query1  = $query1->row_array();
                    echo "<td class='info'><a>$query1[nama_sub]</a>&nbsp;&nbsp;</td>";
                    
                    echo "<td>";
                    echo "&nbsp;&nbsp;<i class='fa fa-eye'></i><a> &nbsp;&nbsp;$rows->nama_guru</a>";
                    echo "</td>";
                    $query  = $this->db->select('id_siswa');
                    $query  = $this->db->where('id_kelas',$rows->id_kelas);
                    $query  = $this->db->get('siswa');
                    $jumlah = $query->num_rows();
                    if($jumlah > 0 ) {
                        echo "<td class='success'><a>Ada $jumlah data</a>&nbsp;&nbsp;</td>";
                    } else {
                        echo "<td class='danger'><a class='text-danger'>Belum ada</a>&nbsp;&nbsp;</td>";
                    }
                    echo "<td>".anchor('kelas/update/kode/'.$rows->id_kelas,'<i class="fa fa-edit"></i> &nbsp;Ubah',array('class'=>''))."</td>";
                    echo '</tr>';
                endforeach;
            else:
            echo "<tr class='danger'><td colspan='6' align='center'>
                  <h3><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Data belum ada</h3>
                  <p>Silahkan buat kelas baru dengan menu yang telah disediakan.</p>
                  </td></tr>";
            endif;
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='6'>
                        <div class="pager">
                            <ul class="pagination">
                                <?php echo $this->pages->create_links();?>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</form>
<div class="modal fade" id="advanced" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" style="display:none">
    <div class="modal-dialog modal-info">
        <div class="modal-content modal-question">
            <div class="modal-header">
                <h4 class="modal-title">Penelusuran Lanjutan</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class='fa fa-undo'></i>&nbsp;Batal</button><button type="button" class="btn btn-info2 btn-sm btn-grad" id="confirm" name="advanced"><i class='fa fa-search'></i>&nbsp; OK</button>	
            </div>
        </div>
    </div>
</div>