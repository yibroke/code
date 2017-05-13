tinymce.init({
        mode : "specific_textareas",
        editor_selector : "mceEditor",
  height: 500,
  relative_urls:false,
  remove_script_host:false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste responsivefilemanager code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager',
  external_filemanager_path:base_url+"/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : base_url+"filemanager/plugin.min.js"},
  content_css: [
  
    '//www.tinymce.com/css/codepen.min.css'
  ]
});