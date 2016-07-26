<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
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
        <table id="dg" title="My Users" class="easyui-datagrid" style="width:700px;height:250px"
               url="../php/Person/getPerson.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="Nombres" width="50">Nombres</th>
                    <th field="Apellidos" width="50">Apellidos</th>
                    <th field="NumeroDocumento" width="50">NumeroDocumento</th>
                    <th field="Edad" width="50">Email</th>
                    <th field="TelefonoFijo" width="50">TelefonoFijo</th>
                    <th field="TelefonoMovil" width="50">TelefonoMovil</th>
                    <th field="Email" width="50">Email</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:60%;height:280px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <form id="fm" method="post" novalidate>
                <div class="col-md-3">
                    <label>Nombres:</label>
                    <input name="Nombres" class="easyui-textbox" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Apellidos:</label>
                    <input name="Apellidos" class="easyui-textbox" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Tipo Documento:</label>
                    <input name="IdTipoDocumento" class="easyui-combobox" data-options="url:'../php/TypeDocument/getTypeDocument.php',textField:'Nombre',valueField:'IdTipoDocumento'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Numero Documento:</label>
                    <input name="NumeroDocumento" class="easyui-textbox" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Edad:</label>
                    <input name="Edad" class="easyui-textbox" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Direcci&oacute;n</label>
                    <input name="Direccion" class="easyui-textbox" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Telefono Fijo:</label>
                    <input name="TelefonoFijo" class="easyui-textbox" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Celular:</label>
                    <input name="TelefonoMovil" class="easyui-textbox" style="width:100%;height:32px" required="true">
                </div>                
                <div class="col-md-3">
                    <label>Correo:</label>
                    <input name="Email" class="easyui-textbox" required="true" style="width:100%;height:32px" validType="email">
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
                url = '../php/Person/savePerson.php';
            }
            function editUser() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Edit User');
                    $('#fm').form('load', row);
                    url = '../php/Person/updatePerson.php?IdPersona=' + row.IdPersona;
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