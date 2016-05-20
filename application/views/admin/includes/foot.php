	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/js/select2/select2.css">

	<!-- Bottom Scripts -->
	<script src="<?php echo base_url() ?>assets/admin/js/gsap/main-gsap.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/bootstrap.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/joinable.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/resizeable.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/neon-api.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/datatables/TableTools.min.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/datatables/jquery.dataTables.columnFilter.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/jquery.validate.min.js" id="script-resource-8"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/datatables/responsive/js/datatables.responsive.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/select2/select2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/neon-chat.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/neon-custom.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/neon-demo.js"></script>
    <script type="text/javascript">
			//<![CDATA[

				// This call can be placed at any point after the
				// <textarea>, or inside a <head><script> in a
				// window.onload event handler.

				// Replace the <textarea id="editor"> with an CKEditor
				// instance, using default configurations.
				try{
				CKEDITOR.replace( 'ckeditor',
                {
                    filebrowserBrowseUrl :'assets/filemanager/browser/default/browser.html?Connector=../../connectors/php/connector.php',
                    filebrowserImageBrowseUrl : 'assets/filemanager/browser/default/browser.html?Type=Image&Connector=../../connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :'assets/filemanager/browser/default/browser.html?Type=Flash&Connector=../../connectors/php/connector.php',
					filebrowserUploadUrl  :'assets/filemanager/connectors/php/upload.php?Type=File',
					filebrowserImageUploadUrl : 'assets/filemanager/connectors/php/upload.php?Type=Image',
					filebrowserFlashUploadUrl : 'assets/filemanager/connectors/php/upload.php?Type=Flash'
				});
				}catch(e){
				console.log(e);	
				}

			//]]>
			</script>
    
    

</body>
</html>