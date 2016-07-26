<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" content="jquery,ui,easy,easyui,web">
        <meta name="description" content="easyui help you build your web page easily!">
        <title>DataGrid Virtual Scrolling with Detail Rows - jQuery EasyUI Demo</title>
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/color.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/demo/demo.css">
        <script type="text/javascript" src="../libs/easyui/jquery.min.js"></script>
        <script type="text/javascript" src="../libs/easyui/jquery.easyui.min.js"></script>
        <script src="../js/functions.js" type="text/javascript"></script>
        <script id="script-lang" src="../libs/easyui/locale/easyui-lang-es.js"></script> 
        <script type="text/javascript" src="../libs/easyui/plugins/datagrid-scrollview.js"></script>
    </head>
    <body>
        <table id="tt" toolbar='#toolbar' title="Usuarios" style="width:100%;height:300px" data-options="
               view:scrollview,rownumbers:true,singleSelect:true,
               url:'../php/User/getUser.php',
               autoRowHeight:true,pageSize:50">
            <thead>
                <tr>
                    <th field="Nombre" width="80">Nombre</th>
                    <th field="NombreCargo" width="90">Cargo</th>
                    <th field="IdRol" width="80">Rol</th>
                    <th field="IdSucursal" width="80" align="right">Sucursal</th>
                    <th field="Activo" width="80" align="right">Estado</th>
                    <th field="PasswordReset" width="90" align="right">Cambio de contraseña</th>
                    <th field="note" width="100">Note</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <div class="ftitle">User Information</div>
            <form id="fm" method="post" novalidate>
                <div class="fitem">
                    <label>Nombre:</label>
                    <input name="Nombre" class="easyui-textbox" required="true">
                </div>
                <div class="fitem">
                    <label>Cargo:</label>
                    <input name="NombreCargo" class="easyui-textbox" required="true">
                </div>
                <div class="fitem">
                    <label>Rol</label>
                    <input class="easyui-combobox" name="IdRol" url='../php/Rol/getRol.php' data-options="textField:'Nombre',valueField:'IdRol'" style="width:100%;height:26px">
                </div>
                <div class="fitem">
                    <label>Email:</label>
                    <select class="easyui-combogrid" style="width:100%" data-options="
                            panelWidth: 500,
                            idField: 'itemid',
                            textField: 'productname',
                            url: '../php/',
                            method: 'get',
                            columns: [[
                            {field:'itemid',title:'Item ID',width:80},
                            {field:'productname',title:'Product',width:120},
                            {field:'listprice',title:'List Price',width:80,align:'right'},
                            {field:'unitcost',title:'Unit Cost',width:80,align:'right'},
                            {field:'attr1',title:'Attribute',width:200},
                            {field:'status',title:'Status',width:60,align:'center'}
                            ]],
                            fitColumns: true
                            ">
                    </select>
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
        </div>
        <script type="text/javascript">
            var url;
            function newUser() {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'New User');
                $('#fm').form('clear');
                url = 'save_user.php';
            }
            function editUser() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Edit User');
                    $('#fm').form('load', row);
                    url = 'update_user.php?id=' + row.id;
                }
            }
            function saveUser() {
                $('#fm').form('submit', {
                    url: url,
                    onSubmit: function () {
                        return $(this).form('validate');
                    },
                    success: function (result) {
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
                $('#tt').datagrid({
                    detailFormatter: function (rowIndex, rowData) {
                        return '<table><tr>' +
                                '<td style="border:0;padding-right:10px">' +
                                '<p>Indentificacion: ' + rowData.IdUsuario + '</p>' +
                                '<p>Correo: ' + rowData.Email + '</p>' +
                                '</td>' +
                                '<td style="border:0">' +
                                '<p>Celular: ' + rowData.Celular + '</p>' +
                                '<p>Usuario SIES: ' + rowData.UsuarioSIES + '</p>' +
                                '</td>' +
                                '<td style="border:0">' +
                                '<p>IP: ' + rowData.DireccionIPIngreso + '</p>' +
                                '<p>Ultimo ingreso: ' + rowData.FechaUltimoIngreso + '</p>' +
                                '</td>' +
                                '<td style="border:0">' +
                                '<p>Fecha Cambio: ' + rowData.FechaCambio + '</p>' +
                                '<p>Cost: ' + rowData.cost + '</p>' +
                                '</td>' +
                                '</tr></table>';
                    }
                });
            });
        </script>
        <style type="text/css">
            .datagrid-header-rownumber,.datagrid-cell-rownumber{
                width:40px;
            }
        </style>
    </body>
</html>