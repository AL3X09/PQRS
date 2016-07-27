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
        <table id="tt" title="Solicitudes" style="width:100%;height:500px" data-options="
               view:scrollview,rownumbers:true,singleSelect:true,
               url:'../php/Header/getHeader.php',
               autoRowHeight:false,pageSize:50" fitColumns="true" toolbar="#toolbar">
            <thead>
                <tr>
                    <th field="nEmpresa" width="100">Empresa</th>
                    <th field="nEmpresaSolicitante" width="130">Empresa Solicitante</th>
                    <th field="valorCliente" width="80">Cliente</th>
                    <th field="nTipoCliente" width="90">Tipo Cliente</th>
                    <th field="FechaCreacion" width="120">Fecha Radicacion</th>
                    <th field="FechaOcurrencia" width="120">Fecha Ocurrencia</th>
                    <th field="FechaEstimadaRespuesta" width="120">FechaEstimadaRespuesta</th>
                    <th field="FechaRespuesta" width="120">Fecha Ocurrencia</th>
                    <th field="nTipoRespuesta" width="120">nTipoRespuesta</th>
                    <th field="nEstado" width="90">Estado</th>

                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nueva Solicitud</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:80%;height:600px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <form id="fm" method="post" novalidate>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Empresa</label>
                    <input id="cc" class="easyui-combobox" name="IdEmpresa" url="../php/Company/getCompany.php" data-options="
                           valueField:'IdEmpresa',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Tipo persona</label>
                    <input id="cc" class="easyui-combobox" name="IdTipoPersona" url="../php/TypePerson/getTypePerson.php" data-options="
                           valueField:'IdTipoPersona',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Persona</label>
                    <input id="cc" class="easyui-combobox"name="IdPersona" url="../php/Person/getPerson.php" data-options="
                           valueField:'IdPersona',
                           textField:'Nombres'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Empresa Solicitante</label>
                    <input id="cc" class="easyui-combobox"name="IdEmpresaSolicitante" url="../php/ApplicantCompany/getApplicantCompany.php" data-options="
                           valueField:'IdEmpresa',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Ciudad</label>
                    <input id="cc" class="easyui-combobox"name="IdCiudad" url="../php/City/getCity.php" data-options="
                           valueField:'IdCiudad',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>                
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Cliente?</label>
                    <div class="col-md-12"><input class="easyui-switchbutton" checked name="Cliente" required="true"/></div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Tipo Cliente</label>
                    <input id="cc" class="easyui-combobox"name="IdTipoCliente" url="../php/TypeClient/getTypeClient.php" data-options="
                           valueField:'IdTipoCliente',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Producto</label>
                    <input id="cc" class="easyui-combobox"name="IdProducto" url="../php/Product/getProduct.php" data-options="
                           valueField:'IdProducto',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Fecha Ocurrencia</label>
                    <div class='input-group datetime' id='FechaOcurrencia'>
                        <input type='text' class="form-control" name="FechaOcurrencia" style="width:100%;height:32px" required="true"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Origen</label>
                    <input id="cc" class="easyui-combobox"name="IdOrigen" url="../php/Origin/getOrigin.php" data-options="
                           valueField:'IdOrigen',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Tipificacion</label>
                    <input id="cc" class="easyui-combobox" name="IdTipificacion" url="../php/Typing/getTyping.php" data-options="
                           valueField:'IdTipificacion',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Estado</label>
                    <input id="cc" class="easyui-combobox" name="IdEstado" url="../php/State/getState.php" data-options="
                           valueField:'IdEstado',
                           textField:'Nombre'" style="width:100%;height:32px" required="true">
                </div>                                
                <div class="col-md-12 col-sm-12 col-xs-12">
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
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nueva Solicitud');
                $('#fm').form('clear');
                url = '../php/Header/saveHeader.php';
            }
            function editUser() {
                var row = $('#tt').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Solicitud');
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
                                '<td style="border:1px solid;padding:10px">' +
                                '<p>Persona: ' + rowData.nPersona + '</p>' +
                                '<p>Tipo Persona: ' + rowData.nTipoPersona + '</p>' +
                                '</td>' +
                                '<td style="border:1px solid;padding:10px">' +
                                '<p>Producto: ' + rowData.nProducto + '</p>' +
                                '<p>Origen: ' + rowData.nOrigen + '</p>' +
                                '</td>' +
                                '<td style="border:1px solid;padding:10px">' +
                                '<p>Ciudad: ' + rowData.nCiudad + '</p>' +
                                '<p>Sucursal: ' + rowData.nSucursalRadicacion + '</p>' +
                                '</td>' +
                                '<td style="border:1px solid;padding:10px">' +
                                '<p>Tipicacion: ' + rowData.nTipificacion + '</p>' +
                                '<p>Responsable: ' + rowData.nUResponsable + '</p>' +
                                '</td>' +
                                '<td style="border:1px solid;padding:10px">' +
                                '<p>Solicitado por: ' + rowData.nUsuarioCreacion + '</p>' +
                                '<p>Comentario: ' + rowData.Comentario + '</p>' +
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