/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.1
    * @package    : IBeESNay
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
$(function() {
    load_editor();
    selectCheck();
    loader();
});

function loader() {
    $('#fuelux-wizard-container')
        .ace_wizard({
    })
    .on('actionclicked.fu.wizard' , function(e, info){				
    })
    .on('finished.fu.wizard', function(e) {
        $('#form-create').submit();
        bootbox.dialog({
            message: "Sedang proses menyimpan ......"
        });
    }).on('stepclick.fu.wizard', function(e){
        e.preventDefault();
    });
    $('#modal-wizard-container').ace_wizard();
    $('#import-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');			
    $('#sidebar2').insertBefore('.page-content').ace_sidebar('collapse', false);
    $('#navbar').addClass('h-navbar');
    $('.footer').insertAfter('.page-content');		   
    $('[data-rel=tooltip]').tooltip({container:'body'});
    $('[data-rel=popover]').popover({container:'body'});
    $('.page-content').addClass('main-content');
    $('.menu-toggler[data-target="#sidebar2"]').insertBefore('.navbar-brand');

    $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
        if(event_name == 'sidebar_fixed') {
            if( $('#sidebar').hasClass('sidebar-fixed') ) {
                $('#sidebar2').addClass('sidebar-fixed')
            } else {
                $('#sidebar2').removeClass('sidebar-fixed')
            }
        }
    }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);

    $('#sidebar2[data-sidebar-hover=true]').ace_sidebar_hover('reset');
    $('#sidebar2[data-sidebar-scroll=true]').ace_sidebar_scroll('reset', true);
    $('.chosen-select').chosen({
        allow_single_deselect:true,
        no_results_text:'Oops, tidak ditemukan hasil apapun: ',
        search_contains: true,
        include_group_label_in_selected: true
    });
    $('#use-protect').click(function(){
        var $checked = $(this).is(':checked');
        if($checked) {
            $('#password-ujian').css({'display':''});
            $('#input-pass-ujian').val('');
            $('#input-pass-ujian').focus();
            $('#input-pass-ujian').setAttribute('required');
            $('#input-pass-ujian').removeAttr('disabled');
        }
        else {
            $('#password-ujian').css({'display':'none'});
            $('#input-pass-ujian').val('');	
        }
    });

    $('#form-confirm-changes').areYouSure({
        message: "PERINGATAN:\n\nApakah anda lupa menyimpan atau memproses data pada form?\n\nSilahkan konfirmasikan jika ingin berpindah halaman."
    });

    $('#form-confirm-changes').bind('dirty.areYouSure', function() {
         $(this).find('button[type="submit"]').removeAttr('disabled');
    });
    $('#form-confirm-changes').bind('clean.areYouSure', function() {
        $(this).find('button[type="submit"]').attr('disabled', 'disabled');
    });

    $("#form").submit(function(e){
        var ff = $("#form");
        var checked = $('input[name="cek_data[]"]:checked').length > 0;
        if(checked) {	
            e.preventDefault();
            $('#confirmDelete').modal('show');	
            $('#confirm').click(function(){
                $("#form").submit();
            });		
        } else {
            bootbox.dialog({
            message: "<h2><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Peringatan:</h2>Pilih atau centang item data yang akan dihapus",
            buttons: {
                "success" : {
                    "label" : "OK",
                    "className" : "btn-sm btn-primary"
                }
            }
            });
            return false;
        }
    });

    $('input[name="cke_pertanyaan"]').click(function() {
        var $checked = $(this).is(':checked');
        var $target = $(this).attr('target-editor');
        if($checked) {
            CKEDITOR.instances['epertanyaan'].updateElement();
            CKEDITOR.replace('epertanyaan');
        } else {
            CKEDITOR.instances['epertanyaan'].updateElement();
            CKEDITOR.instances['epertanyaan'].destroy();		
        }
    });
    $('input[name="cke_referensi"]').click(function() {
        var $checked = $(this).is(':checked');
        var $target = $(this).attr('target-editor');
        if($checked) {
            CKEDITOR.replace('ereferensi');
        } else {
            CKEDITOR.instances['ereferensi'].updateElement();
            CKEDITOR.instances['ereferensi'].destroy();	
        }
    });
}


function get_bsoal_type(bstype) {
    var bsoal_type = bstype;
    window.location = bsoal_type;
}

function selectCheck() {
    $("tr").click(function(e){
        var i =$("td:first-child",this).find("input[type='checkbox']");
        var c = i.is(':checked');
        if($(e.target).is('a')) {
        } else if(i.length) {
            if(c) {
                i.prop('checked', 0);
                //$(this).removeClass('success');
            } else {
                i.prop('checked', 1);
                //$(this).addClass('success');
                //$('.success').removeClass('success');
            }
        }
    });
	
    $('input[type="checkbox"]').click(function(){	
        var $checked = $(this).is(':checked');
        var $target = $(this).attr('target');
        var $subs = $(this).attr('sub-target');
        if($subs) {
            $target = $(this).attr('value');
            var $checkbox = $('input[data-parent="'+$target+'"]');
        } else {
            var $checkbox = $('input[name="'+$target+'"]');
        }
        $('input[type="checkbox"]').next().removeClass('input-error');
        $('input[type="radio"]').next().removeClass('input-error');		
        if($checked) {			
            $checkbox.prop('checked', 1);					
            $($checkbox).parents('table tr').addClass('active');					
        } else {
            $checkbox.prop('checked', 0);	
            $($checkbox).parents('table tr').removeClass('active');				
        }
    });
	
    $('[target-radio], label[target], radio-name[target]').click(function(e){			
        var $target = $(this).attr('target-radio');
        var $type = $(this).attr('target-type');
        var $checkbox = $('input[data-name="'+$target+'"]');
        var $checked = $($checkbox).is(':checked');
        if($type == 'multiple')
            var $checkbox = $('input[name="'+$target+'"]');
            $('input[type="checkbox"]').next().removeClass('input-error');
            $('input[type="radio"]').next().removeClass('input-error');
        if($(e.target).is('.switch *, a[href]')) {
        } else {
            $('tr').removeClass('active');	
            if($checked) {
                $checkbox.prop('checked', 0);					
            } else {
                $checkbox.prop('checked', 1);	
                if($('tr')) $(this).addClass('active');
            }
        }
    });		
}

function load_editor() {
    var waitCKEDITOR = setInterval(function() {
        if(window.CKEDITOR) {
            CKEDITOR.replace('epertanyaan',{removePlugins:'elementspath'});
            CKEDITOR.replace('ereferensi');
            CKEDITOR.replace('editor-1');
            CKEDITOR.replace('editor-2');
            CKEDITOR.replace('editor-3');
            CKEDITOR.replace('editor-4');
            CKEDITOR.replace('editor-5');
            CKEDITOR.replace('editor-6');
            CKEDITOR.replace('editor-7');
        }
    },100);
}