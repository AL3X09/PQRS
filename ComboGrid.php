<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basic ComboGrid - jQuery EasyUI Demo</title>
        <link href="../libs/easyui/themes/default/easyui.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/themes/icon.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/demo.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/jquery.min.js" type="text/javascript"></script>
        <script src="../libs/easyui/jquery.easyui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <h2>Basic ComboGrid</h2>
        <p>Click the right arrow button to show the DataGrid.</p>
        <div style="margin:20px 0"></div>
        <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
            <div style="margin-bottom:20px">
                <label class="label-top">Select Item:</label>
                <select class="easyui-combogrid" style="width:100%" data-options="
                        panelWidth: 500,
                        idField: 'IdTipificacion',
                        textField: 'Nombre',
                        url: '../php/getTyping.php',
                        method: 'get',
                        columns: [[
                        {field:'IdTipificacion',title:'IdTipificacion',width:80},
                        {field:'Nombre',title:'Nombre',width:120}
                        ]],
                        fitColumns: true
                        ">
                </select>
            </div>
        </div>
    </body>
</html>