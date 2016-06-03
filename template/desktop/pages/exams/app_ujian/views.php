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
if($verify_status){ echo "<div class='alert alert-danger'>".$verify_status."</div>"; }
?>
<div class='space-6'></div>
<div>
    <table id="data-table" class="tablenay table table-striped table-bordered table-hover" data-tablenay-mode="stack" data-tablenay-sortable data-tablenay-sortable-switch data-tablenay-minimap data-tablenay-mode-switch>
        <thead>
            <tr>
                <th style="width:3% !important;" class="center no-sortable">
                    #
                </th>
                <th scope="col" data-tablenay-sortable-col data-tablenay-priority="persist" style="width:20% !important;">Topik Ujian</th>
                <th scope="col" data-tablenay-sortable-col data-tablenay-sortable-default-col data-tablenay-priority="3" style="width:20% !important;">Kategori</th>
                <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:6% !important;">Waktu</th>
                <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:3% !important;">Terbit</th>
                <th scope="col" data-tablenay-priority="3" style="width:15% !important;color:#555">Pilihan</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        if($record->num_rows() > 0):
            $nomor = 1;
            foreach($record->result() as $rows):
                echo "<tr>";
                echo "<td align='center'>$nomor.
                     </td>";
                echo "<td>$rows->judul</td>";
                echo "<td>$rows->nama_kategori</td>";
                echo "<td>$rows->durasi</td>";
                echo "<td>$rows->terbit</td>";
                echo "<td>";
                echo anchor('exams/ujian/akses/'.$rows->id_ujian,'<i class="fa fa-question-circle"></i> &nbsp;akses&nbsp;&nbsp;&nbsp;&nbsp;',array('class'=>''));
                echo "</td>";
                echo "</tr>";
                $nomor++;
            endforeach;
        else:
        echo "<tr class='danger'><td colspan='6' align='center'>
             <h3><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Data belum ada</h3>
             </td></tr>";
        endif;
        ?>
        </tbody>
    </table>
</div>
