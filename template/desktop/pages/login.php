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
?>
<div class="col-sm-10 col-sm-offset-1">
    <div class="login-container">
        <div class="space-6"></div>
        <div class="space-6"></div>
        <div class="space-6"></div>
        <div class="space-6"></div>
        
        <div class="center">
            <h4 class="light-blue" id="id-company-text"> &copy; COMBAT ID</h4>
        </div>

        <div class="space-6"></div>
            <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header blue lighter bigger">
                                <i class="ace-icon fa fa-desktop green"></i>&nbsp;&nbsp;
                                LOG IN PANEL
                            </h4>
                            <div class="space-6"></div>
                            <?php echo form_open('login/user_login',array('id'=>'form-login'));?>
                                <fieldset>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username" />
                                        <i class="ace-icon fa fa-user"></i>
                                        </span>
                                    </label>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                        <input type="password" name="password" class="form-control" placeholder="Password" />
                                        <i class="ace-icon fa fa-lock"></i>
                                        </span>
                                    </label>
                                      <div class="space-4"></div>
                               <div class="social-or-login center">
                                <span class="bigger-110">LEVEL AKSES LOG IN</span>
                            </div>
                            <div class="space-6"></div>
                            <div class="social-login center">
                                <div class="radio">
                                <label><input class="ace" type="radio" name="level" value="admin"> <span class="lbl"> Admin</span></label>
                                <label><input class="ace" type="radio" name="level" value="pengajar"> <span class="lbl"> Guru</span></label>
                                <label><input class="ace" type="radio" name="level" checked value="siswa"> <span class="lbl"> Siswa</span></label>
                                </div>
                            </div>
                                    <div class="clearfix">
                                                            
                                        <button id="submit-login" style="width: 100%" type="submit" class="btn btn-sm btn-primary">
                                            <i class="ace-icon fa fa-lock"></i>
                                            <span class="bigger-110 ">&nbsp;MASUK</span>
                                        </button>
                                    </div>

                                </fieldset>
                            </form>


                            </div><!-- /.widget-main -->
                            <div class="toolbar clearfix">
                                <div style="text-align: center">
                                </div>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.login-box -->
                </div><!-- /.position-relative -->
            </div>
        </div><!-- /.col -->