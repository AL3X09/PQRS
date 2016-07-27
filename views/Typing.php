<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basic TreeGrid - jQuery EasyUI Demo</title>
        <link href="../libs/easyui/themes/default/easyui.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/themes/icon.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/demo/demo.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/jquery.min.js" type="text/javascript"></script>
        <script src="../libs/easyui/jquery.easyui.min.js" type="text/javascript"></script>
        <link href="../libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h2>Basic TreeGrid</h2>
        <p>TreeGrid allows you to expand or collapse group rows.</p>
        <div style="margin:20px 0;"></div>
        <table title="Folder Browser" id='dg' class="easyui-treegrid"  toolbar='#toolbar' style="width:100%;height:250px"
               data-options="
               url: '../php/Typing/getTyping.php',
               method: 'post',
               rownumbers: true,
               idField: 'IdTipificacion',
               treeField: 'Nombre',
               onBeforeLoad: function(row,param){
               if (!row) {	// load top level rows
               param.id = 0;	// set id=0, indicate to load new page rows  
               }else{
               param.id = row.IdTipificacion;
               }
               },onLoadSuccess:function(row,data){               

               },onLoadError:function (error){

               }
               ">
            <thead>
            <div id="toolbar">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nueva Opcion</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
            </div>
            <tr>
                <th data-options="field:'Nombre'" width="220">Nombre</th>
                <th data-options="field:'CodigoSuper'" width="150">Codigo Super</th>
                <th data-options="field:'TiempoEstimadoRespuesta'" width="150">Tiempo de respuesta</th>
                <th data-options="field:'total'" width="150">Total</th>
            </tr>
        </thead>
    </table>
    <div id="dlg" class="easyui-dialog" style="width:40%;height:480px;padding:10px 20px"
         closed="true" buttons="#dlg-buttons">
        <form id="fm" method="post" novalidate>
            <div class="col-md-6">
                <label class="label-top">Nombre</label>
                <input name="Nombre" field='Nombre' class="easyui-textbox" style="width:100%;height:32px" required="true">
            </div>
<!--            <div class="col-md-6">
                <label class="label-top">Dependecia</label>
                <input class="easyui-combotree" field='Padre' name="Padre" style="width:100%;height:32px" id="cc" data-options="
                       url:'../php/Typing/getTyping.php',
                       method:'post',                   
                       onBeforeLoad: function(row,param){
                       if (!row) {	// load top level rows
                       param.id = 0;	// set id=0, indicate to load new page rows  
                       }else{
                       param.id = row.IdTipificacion;
                       }
                       },onLoadSuccess:function(row,data){               

                       },onLoadError:function (error){

                       },
                       valueField:'IdTipificacion',
                       textField:'text'
                       "  style="width:100%">
            </div>-->
            <div class="col-md-6">
                <label class="label-top">Modulo</label>
                <input class="easyui-combobox" name="IdModulo" style="width:100%;height:32px" id="cc" data-options="
                       url:'../php/Module/getModule.php',
                       method:'get',
                       valueField:'IdModulo',
                       textField:'Nombre'
                       "  style="width:100%">
            </div>
            <div class="col-md-6">
                <label class="label-top">Empresa</label>
                <input class="easyui-combobox" name="IdEmpresa" style="width:100%;height:32px" id="cc" data-options="
                       url:'../php/Company/getCompany.php',
                       method:'get',
                       valueField:'IdEmpresa',
                       textField:'Nombre'
                       "  style="width:100%">
            </div>
            <div class="col-md-6">
                <label class="label-top">CodigoSuper</label>
                <input name="CodigoSuper" field='CodigoSuper' class="easyui-numberbox" style="width:100%;height:32px" required="true">
            </div>                        
            <div class="col-md-6">
                <label class="label-top">Tiempo estimado respuesta</label>
                <div class='input-group datetime' id='TiempoEstimadoRespuesta'>
                    <input type='text' class="form-control" name="TiempoEstimadoRespuesta" style="width:100%;height:32px" />
                    <span class="input-group-addon" style="height:13px">
                        <span class="glyphicon glyphicon-calendar" ></span>
                    </span>
                </div>
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
            var row = $('#dg').datagrid('getSelected');
            if (row && row.state === 'closed') {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nueva Opcion');
                $('#fm').form('clear');
                url = '../php/Typing/saveTyping.php?Padre=' + row.IdTipificacion;
            }
        }
        function editUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Opcion');
                $('#fm').form('load', row);
                url = '../php/Typing/updateTyping.php?id=' + row.id;
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
                }, error: function (error) {
                    consol.log(error);
                }
            });
        }

    </script>
    <script src="../libs/bootstrap/moment/moment.js" type="text/javascript"></script>
    <script src="../libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../libs/bootstrap/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="../libs/bootstrap/moment/locale/es.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#TiempoEstimadoRespuesta').datetimepicker({
                format: "DD-MM-YYYY HH:mm",
                locale: 'es',
                daysOfWeekDisabled: [0, 6],
                enabledHours: [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
                minDate: new Date()
            });
        });
    </script>
</body>
</html>