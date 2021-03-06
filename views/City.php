<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ciudades</title>
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/color.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/demo/demo.css">
        <link href="../libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="../libs/easyui/jquery.min.js"></script>
        <script type="text/javascript" src="../libs/easyui/jquery.easyui.min.js"></script>
    </head>
    <body>
        <table id="dg" title="Ciudades" class="easyui-datagrid" style="width:100%;height:500px"
               url="../php/City/getCity.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="Nombre" width="50">Nombre</th>
                    <th field="CodigoDANE" width="50">Codigo DANE</th>
                    <th field="CodigoTercero" width="50">Codigo tercero</th>
                    <th field="IdDepartamento" width="50">Departamento</th>
                    <th field="Activo" width="50">Estado</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nueva Ciudad</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:60%;height:300px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <legend>Informacion Ciudad</legend>
            <form id="fm" method="post" novalidate>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <label>Nombre</label>
                    <input name="Nombre" class="easyui-textbox" required="true" style="width:100%;height:32px;">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <label>Codigo DANE</label>
                    <input name="CodigoDANE" class="easyui-textbox" required="true" style="width:100%;height:32px;">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <label>Codigo Tercero</label>
                    <input name="CodigoTercero" class="easyui-textbox" required="true" style="width:100%;height:32px;">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <label>Departamento</label>
                    <input name="IdDepartamento" class="easyui-combobox" style="width:100%;height:32px;" data-options="url:'../php/Department/getDepartment.php',textField:'Nombre',valueField:'IdDepartamento'" required="true" >
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <label>Estado</label>
                    <input name="Activo" id="Activo" class="easyui-switchbutton" style="width:100%;height:32px;" required="true" >
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
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nueva Ciudad');
                $('#fm').form('clear');
                url = '../php/City/saveCity.php';
            }
            function editUser() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Ciudad');
                    $('#fm').form('load', row);
                    url = '../php/City/updateCity.php?IdCiudad=' + row.IdCiudad;
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