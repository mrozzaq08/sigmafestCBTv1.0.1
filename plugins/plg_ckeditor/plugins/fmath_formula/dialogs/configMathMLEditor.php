<?php
$server_addr = $_SERVER['HTTP_HOST'];
$base_url = (!empty($_SERVER['HTTPs']) ? 'https' : 'http').'://'.$server_addr
			.substr($_SERVER['SCRIPT_NAME'], 
			0, strpos($_SERVER['SCRIPT_NAME'], 
			basename($_SERVER['SCRIPT_FILENAME'])));
$base_url = str_replace("plugins/plg_ckeditor/plugins/fmath_formula/dialogs/","",$base_url);
?>

<?xml version="1.0" encoding="utf-8"?>
<configuration>
	<translate>
		<text id="helpMsg">Gunakan "tanda panah" dan "tab" untuk memindahkan kursor, "enter" untuk membuat elemen baru, "delete", "backspace" ...</text>
		<text id="matrixChoiceLines">Nb of Lines:</text>
		<text id="matrixChoiceColumns">Nb of columns:</text>		
		<text id="matrixChoiceButton">Create matrix</text>				
	</translate>
	<properties>
		<!--property id="width">900</property>
		<property id="height">500</property>		
		<property id="disableSave">true</property>
		<property id="disableOpen">true</property>
		<property id="enableClose">true</property>
		<property id="local">true</property>
		<property id="defaultFont">fraktur</property>		
		<property id="defaultFontSize">30</property>		
		<property id="defaultBold">true</property>		
		<property id="defaultItalic">true</property>		
		<property id="defaultForegroundColor">#ff0000</property>		
		<property id="fontList">fraktur,script</property-->
		<property id="defaultFontSize">16</property>
		<property id="loadOnInit">true</property>
		<property id="urlGenerateImage"><?php echo $base_url;?>formula/capture.php</property>
		<property id="defaultImageType">PNG</property>
		<property id="defaultImageCompression">100</property>
		<property id="designId">CKE</property>		
		<property id="theme">CKELookEditorBlue.xml</property>
		
		<!--property id="loadJapaneseFonts">true</property-->
	</properties>
	<toolbars>
		<!--toolbar id="toolbar_top1" disabled="true"/>
		<toolbar id="toolbar_top2" disabled="true"/-->		
	</toolbars>
	<buttons>
		<!--button id="toolbar_Equation1" disabled="true"/>
		<button id="toolbar_Fraction1" disabled="true"/-->		
	</buttons>	
	<lookandfeeldesigns>
		<design lookId="CKE" translateCode="lookAndFeelCKE"/>		
	</lookandfeeldesigns>	
	<lookandfeelthemes>
		<theme lookId="CKE" translateCode="lookAndFeelCKEBlue" file="CKELookEditorBlue.xml" />		
	</lookandfeelthemes>	
	<languages>
		<langue translateCode="languageEn" file="EditorTextEn.xml" />		
	</languages>
</configuration>
