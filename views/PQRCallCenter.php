<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" content="jquery,ui,easy,easyui,web">
        <meta name="description" content="easyui help you build your web page easily!">
        <title>Call Center</title>
        <link href="../libs/easyui/themes/material/easyui.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/themes/icon.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/demo/demo.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/jquery.min.js" type="text/javascript"></script>
        <script src="../libs/easyui/jquery.easyui.min.js" type="text/javascript"></script>
        <script src="../libs/easyui/plugins/datagrid-scrollview.js" type="text/javascript"></script>
        <link href="../libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/locale/easyui-lang-es.js" type="text/javascript"></script>
        <link href="../libs/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <table id="tt" title="Solicitudes" style="width:100%;height:300px" data-options="
               view:scrollview,rownumbers:true,singleSelect:true,
               url:'../php/Header/getHeader.php',
               autoRowHeight:false,pageSize:50" toolbar="#toolbar">
            <thead>
                <tr>
                    <th field="nEmpresa" width="90">Empresa</th>
                    <th field="nTipoPersona" width="80">Tipo Persona</th>
                    <th field="nPersona" width="80" align="right">Persona</th>
                    <th field="nEmpresaSolicitante" width="80" align="right">Empresa Solicitante</th>
                    <th field="nCiudad" width="90" align="right">Ciudad</th>
                    <th field="ValorCliente" width="100">Cliente</th>
                    <th field="nTipoCliente" width="100">Tipo Cliente</th>
                    <th field="nProducto" width="100">Producto</th>
                    <th field="FechaOcurrencia" width="100">Fecha Ocurrencia</th>
                    <th field="nOrigen" width="100">IdOrigen</th>
                    <th field="nModulo" width="100">Modulo</th>
                    <th field="Comentario" width="100">Comentario</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:80%;height:600px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <form id="fm" method="post" novalidate>
                <div class="col-md-3">
                    <label>Empresa</label>
                    <input id="cc" class="easyui-combobox" name="IdEmpresa" url="../php/Company/getCompany.php" data-options="
                           valueField:'IdEmpresa',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Tipo persona</label>
                    <input id="cc" class="easyui-combobox" name="IdTipoPersona" url="../php/TypePerson/getTypePerson.php" data-options="
                           valueField:'IdTipoPersona',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Persona</label>
                    <input id="cc" class="easyui-combobox"name="IdPersona" url="../php/Person/getPerson.php" data-options="
                           valueField:'IdPersona',
                           textField:'Nombres'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Empresa Solicitante</label>
                    <input id="cc" class="easyui-combobox"name="IdEmpresaSolicitante" url="../php/ApplicantCompany/getApplicantCompany.php" data-options="
                           valueField:'IdEmpresa',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Ciudad</label>
                    <input id="cc" class="easyui-combobox"name="IdCiudad" url="../php/City/getCity.php" data-options="
                           valueField:'IdCiudad',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>                
                <div class="col-md-3">
                    <label>Cliente?</label>
                    <div class="col-md-12"><input class="easyui-switchbutton" checked name="Cliente" required="true"/></div>
                </div>
                <div class="col-md-3">
                    <label>Tipo Cliente</label>
                    <input id="cc" class="easyui-combobox"name="IdTipoCliente" url="../php/TypeClient/getTypeClient.php" data-options="
                           valueField:'IdTipoCliente',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Producto</label>
                    <input id="cc" class="easyui-combobox"name="IdProducto" url="../php/Product/getProduct.php" data-options="
                           valueField:'IdProducto',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Fecha Ocurrencia</label>
                    <div class='input-group datetime' id='FechaOcurrencia'>
                        <input type='text' class="form-control" name="FechaOcurrencia" style="width:100%;height:32px" required="true"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Origen</label>
                    <input id="cc" class="easyui-combobox"name="IdOrigen" url="../php/Origin/getOrigin.php" data-options="
                           valueField:'IdOrigen',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Tipificacion</label>
                    <input id="cc" class="easyui-combobox"name="IdModulo" url="../php/Typing/getTyping.php" data-options="
                           valueField:'IdTipificacion',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Estado</label>
                    <input id="cc" class="easyui-combobox" name="IdEstado" url="../php/State/getState.php" data-options="
                           valueField:'IdEstado',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3">
                    <label>Usuario Responsable</label>
                    <input id="cc" class="easyui-combobox"name="UResponsable" url="../php/User/getUser.php" data-options="
                           valueField:'IdUsuario',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>                
                <div class="col-md-12">
                    <label>Comentario</label>
                    <input class="easyui-textbox" name="Comentario" data-options="multiline:true" style="width: 100%;height:60px" required="true"/>
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
                url = '../php/Header/saveHeader.php';
            }
            function editUser() {
                var row = $('#tt').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Edit User');
                    $('#fm').form('load', row);
                    url = '../php/Header/updateHeader.php?IdPqrEncabezado=' + row.IdPqrEncabezado;
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
        <script src="../libs/bootstrap/moment/moment.js" type="text/javascript"></script>
        <script src="../libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../libs/bootstrap/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="../libs/bootstrap/moment/locale/es.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#FechaOcurrencia').datetimepicker({
                    format: "DD-MM-YYYY HH:mm",
                    locale: 'es',
                    daysOfWeekDisabled: [0, 6],
                    enabledHours: [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
                    minDate: new Date()
                });

            });
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
        <script type="text/javascript">
            $(function () {
                $('#tt').datagrid({
                    detailFormatter: function (rowIndex, rowData) {
                        return '<table style="border:1px solid;"><tr>' +
                                '<td style="border:1px solid;padding-right:10px">' +
                                '<p>Name: ' + rowData.name + '</p>' +
                                '<p>Amount: ' + rowData.amount + '</p>' +
                                '</td>' +
                                '<td style="border:1px solid">' +
                                '<p>Price: ' + rowData.price + '</p>' +
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