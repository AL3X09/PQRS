<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion Empresas</title>
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/themes/color.css">
        <link rel="stylesheet" type="text/css" href="../libs/easyui/demo/demo.css">
        <link href="../libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../libs/easyui/jquery.easyui.min.js"></script>
        <script src="../libs/easyui/locale/easyui-lang-es.js" type="text/javascript"></script>
        <link href="../libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <table id="dg" title="Empresas" class="easyui-datagrid" style="width:100%;height:500px"
               url="../php/Company/getCompany.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="false" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="IdEmpresa" width="10">#</th>
                    <th field="Nombre" width="50">Nombre</th>                    
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nueva Empresa</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Empresa</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <legend>Informacion Empresa</legend>
            <form id="fm" method="post" novalidate>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
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
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Empresa');
                $('#fm').form('clear');
                url = '../php/Company/saveCompany.php';
            }
            function editUser() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Empresa');
                    $('#fm').form('load', row);
                    url = '../php/Company/updateCompany.php?id=' + row.IdEmpresa;
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
                            $.messager.show({
                                title: 'Notificacion',
                                msg: result,
                                showType: 'show'
                            });
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