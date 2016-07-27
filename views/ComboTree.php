<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basic ComboTree - jQuery EasyUI Demo</title>
        <link href="../libs/easyui/themes/default/easyui.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/themes/icon.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/demo.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/jquery.min.js" type="text/javascript"></script>
        <script src="../libs/easyui/jquery.easyui.min.js" type="text/javascript"></script>
    </head>
    <body>    
        <div style="margin:20px 0"></div>
        <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
            <div style="margin-bottom:20px">
                <label class="label-top">Select Node:</label>
                <input class="easyui-combotree" id="cc" data-options="
                       url:'../php/getTyping.php',
                       method:'post',                   
                       onBeforeLoad: function(row,param){
                       if (!row) {	// load top level rows
                       param.id = 0;	// set id=0, indicate to load new page rows  
                       }else{
                       param.id = row.IdTipificacion;
                       }
                       },onLoadSuccess:function(row,data){               
                       //console.log(data);
                       },onLoadError:function (error){
                       //console.log(error);
                       }
                       "  style="width:100%">
            </div>
        </div>
    </body>
</html>