<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tipo Linea de Tiempo</title>
        <link href="../libs/easyui/themes/material/easyui.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/themes/icon.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/demo/demo.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/jquery.min.js" type="text/javascript"></script>
        <script src="../libs/easyui/jquery.easyui.min.js" type="text/javascript"></script>
        <script src="../libs/easyui/plugins/datagrid-scrollview.js" type="text/javascript"></script>
        <link href="../libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/locale/easyui-lang-es.js" type="text/javascript"></script>
    </head>
    <body>
        <table id="dg" title="Tipos de linea de tiempo" class="easyui-datagrid" style="width:100%;height:500px"
               url="../php/TypeLineTime/getTypeLineTime.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="Nombre" width="50">Nombre</th>                    
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo Tipo Linea</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:60%;height:250px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <legend>Informacion Pais</legend>
            <form id="fm" method="post" novalidate>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <label>Nombre</label>
                    <input name="Nombre" class="easyui-textbox" style="width:100%;height:32px;" required="true">
                </div>                
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
        <script type="text/javascript">
            var url;
            function newUser() {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Tipo de linea');
                $('#fm').form('clear');
                url = '../php/TypeLineTime/saveTypeLineTime.php';
            }
            function editUser() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Tipo de linea');
                    $('#fm').form('load', row);
                    url = '../php/TypeLineTime/updateTypeLineTime.php?IdTipoLineaTiempo=' + row.IdTipoLineaTiempo;
                }
            }
            function saveUser() {
                $('#fm').form('submit', {
                    url: url,
                    onSubmit: function () {
                        return $(this).form('validate');
                    },
                    success: function (result) {
                        console.log(result);
                        var result = eval('(' + result + ')');
                        if (result.errorMsg) {
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                            $('#dlg').dialog('close');        // close the dialog
                            $('#dg').datagrid('reload');    // reload the user data
                        }
                    }
                });
            }
            $(function () {
                $('#Activo').switchbutton({
                    onText: 'Activo',
                    offText: 'Inactivo'
                })
            })

        </script>
        <style type="text/css">
            #fm{
                margin:0;
                padding:10px 30px;
            }
            .ftitle{
                font-size:14px;
                font-weight:bold;
                padding:5px 0;
                margin-bottom:10px;
                border-bottom:1px solid #ccc;
            }
            .fitem{
                margin-bottom:5px;
            }
            .fitem label{
                display:inline-block;
                width:80px;
            }
            .fitem input{
                width:160px;
            }
        </style>
    </body>
</html>